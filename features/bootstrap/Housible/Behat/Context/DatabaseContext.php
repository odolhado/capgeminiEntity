<?php

namespace Housible\Behat\Context;

use Behat\Behat\Context\Context;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

class DatabaseContext implements Context
{
    private $entityManager;

    public function __construct(EntityManager $manager)
    {
        $this->entityManager = $manager;
    }

    /**
     * @BeforeScenario @database
     */
    public function prepare()
    {
        $purger = new ORMPurger();
        $executor = new ORMExecutor($this->getEntityManager(), $purger);
        $executor->purge();
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }
}
