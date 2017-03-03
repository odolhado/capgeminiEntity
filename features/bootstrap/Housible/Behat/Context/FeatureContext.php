<?php

namespace Housible\Behat\Context;

use AppBundle\Manager\PersonManager;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{

    private $personManager;

    /**
     * @param PersonManager $personManager
     */
    public function __construct(PersonManager $personManager)
    {
        $this->personManager = $personManager;
    }

}
