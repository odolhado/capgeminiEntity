<?php

namespace AppBundle\Controller;

use AppBundle\Controller\Component\FormedControllerTrait;
use AppBundle\Controller\Component\ManagedControllerTrait;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends FOSRestController
{
    use FormedControllerTrait;
    use ManagedControllerTrait;

    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
        ]);

    }

}
