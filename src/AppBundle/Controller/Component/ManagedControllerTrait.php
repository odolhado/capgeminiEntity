<?php

namespace AppBundle\Controller\Component;


use AppBundle\Manager\ManagerInterface;

trait ManagedControllerTrait
{

    private $manager;

    /**
     * @return ManagerInterface
     */
    public function getManager()
    {
        return $this->manager;
    }

    public function setManager(ManagerInterface $manager)
    {
        $this->manager = $manager;
    }

}
