<?php

namespace AppBundle\Controller;

use AppBundle\Controller\Component\FormedControllerTrait;
use AppBundle\Controller\Component\ManagedControllerTrait;
use AppBundle\Entity\Person;
use AppBundle\Form\Type\PersonType;
use AppBundle\Manager\PersonManager;
use Doctrine\Common\Util\Debug;
use FOS\RestBundle\View\View;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
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
     * @param $id
     * @return View
     */
    public function getAction($id)
    {
        try {
            $person = $this->getPerson($id);

            return new View($person, Response::HTTP_OK, ['get']);

        } catch (\Exception $e) {
            return new View($e->getMessage(), Response::HTTP_CONFLICT);
        }
    }

    /**
     * @param $request Request
     * @return View|\Symfony\Component\Form\FormInterface
     */
    public function createAction(Request $request)
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
     * @param Request $request
     * @return View|\Symfony\Component\Form\FormInterface
     */
    public function putAction(Request $request)
    {
        $form = $this->formFactory->createNamed('', PersonType::class);
        $form->submit($request->request->all(), false);

        try {
            if ($form->isValid()) {
                /** @var Person $person */
                $person = $form->getData();

                $this->getManager()->update($person);
                $this->getManager()->flush();

                return new View(null, Response::HTTP_NO_CONTENT);
            }

            return $form;

        } catch (\Exception $e) {
            return new View($e->getMessage(), Response::HTTP_CONFLICT);
        }
    }

    /**
     * @param $request Request
     * @param $id
     * @return View|\Symfony\Component\Form\FormInterface
     */
    public function updateAction(Request $request, $id)
    {
        try {
            $person = $this->getPerson($id);

            $form = $this->formFactory->createNamed('', PersonType::class, $person);
            $form->submit($request->request->all(), false);

            if ($form->isValid()) {
                $person = $form->getData();

                $this->getManager()->update($person);
                $this->getManager()->flush();

                return new View(null, Response::HTTP_NO_CONTENT);
            }

            return $form;

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
        try {
            $person = $this->getPerson($id);

            $this->getManager()->delete($person);
            $this->getManager()->flush();

            return new View(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return new View($e->getMessage(), Response::HTTP_CONFLICT);
        }
    }

    /**
     * @param $id
     * @return Person
     */
    private function getPerson($id)
    {
        /** @var Person $person */
        $person = $this->getManager()->find($id);
        if (!$person instanceof Person) {
            throw new NotFoundHttpException(sprintf("Person {id: %s} does not exists", $id));
        }

        return $person;
    }

}
