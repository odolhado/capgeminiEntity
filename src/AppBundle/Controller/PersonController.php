<?php

namespace AppBundle\Controller;

use AppBundle\Controller\Component\FormedControllerTrait;
use AppBundle\Controller\Component\ManagedControllerTrait;
use AppBundle\Entity\Person;
use AppBundle\Form\Type\PersonType;
use AppBundle\Manager\PersonManager;
use FOS\RestBundle\View\View;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\InvalidParameterException;


class PersonController
{

    use FormedControllerTrait;
    use ManagedControllerTrait;


    /**
     * PersonController constructor.
     * @param PersonManager $manager
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(PersonManager $manager, FormFactoryInterface $formFactory)
    {
        $this->setManager($manager);
        $this->setFormFactory($formFactory);
    }

    /**
     * @param $request
     * @return View|\Symfony\Component\Form\FormInterface
     */
    public function createAction($request)
    {
        $form = $this->formFactory->createNamed('', PersonType::class);
        $form->submit($request->request->all());

        if ($form->isValid()) {

            $person = $form->getData();

            try {
                $this->getManager()->create($person);
                $this->getManager()->flush();

                return new View(['id' => $person->getId()], Response::HTTP_CREATED);
            } catch (\Exception $e) {
                return new View($e->getMessage(), Response::HTTP_CONFLICT);
            }
        }

        return $form;
    }

    /**
     * @param $id
     * @return View
     */
    public function getAction($id)
    {
        $person = $this->getManager()->find($id);

        if (!$person) {
            throw new NotFoundHttpException(sprintf("Person %s does not exists", $id));
        }

        return new View($person, Response::HTTP_OK, ['get']);
    }

    /**
     * @param $request
     * @param $id
     * @return View
     */
    public function updateAction($request, $id)
    {
        /** @var Person $person */
        $person = $this->getManager()->find($id);

        if (!$person) {
            throw new NotFoundHttpException(sprintf("Document %s %s does not exists", $id, Person::class));
        }

        $form = $this->formFactory->createNamed('', PersonType::class, $person);
        $form->submit($request->request->all(), false);

        try {
            if ($form->isValid()) {
                $person = $form->getData();

                $this->getManager()->update($person);
                $this->getManager()->flush();
            }

            return new View(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return new View($e->getMessage(), Response::HTTP_CONFLICT);
        }
    }

    /**
     * @param $id
     * @return View
     */
    public function deleteAction($id)
    {
        $person = $this->getManager()->find($id);

        if (!$person) {
            throw new NotFoundHttpException('Category does not exists');
        }

        try {
            $this->getManager()->delete($person);
            $this->getManager()->flush();

            return new View(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return new View($e->getMessage(), Response::HTTP_CONFLICT);
        }
    }

}
