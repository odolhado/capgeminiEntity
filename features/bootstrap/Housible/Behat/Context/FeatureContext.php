<?php

namespace Housible\Behat\Context;

use AppBundle\Manager\PersonManager;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, KernelAwareContext
{

    use KernelDictionary;

    private $kernel;
    private $personManager;
    private $manager;

    /**
     * @param EntityManager $manager
     */
    public function __construct(EntityManager $manager, PersonManager $personManager)
    {
        $this->manager = $manager;
        $this->personManager = $personManager;
    }

    public function setKernel(KernelInterface $kernelInterface)
    {
        $this->kernel = $kernelInterface;
    }
}
