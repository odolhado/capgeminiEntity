<?php

namespace Housible\Behat\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Codifico\ParameterBagExtension\Context\ParameterBagDictionary;
use Coduo\PHPMatcher\Factory\SimpleFactory;

class MatcherContext implements Context
{
    use ParameterBagDictionary;

    /**
     * @var \Twig_Loader_Array
     */
    private $loader;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    function __construct()
    {
        $this->loader = new \Twig_Loader_Array([]);
        $this->twig = new \Twig_Environment($this->loader);
    }

    /**
     * @Then the JSON should match pattern:
     * @Then the JSON response should match pattern:
     * @Then the XML response should match pattern:
     *
     * @param PyStringNode $string
     *
     * @throws \Exception
     */
    public function theJsonShouldMatchPattern(PyStringNode $string)
    {
        $name = md5($string);
        $this->loader->setTemplate($name, (string)$string);
        $expected = $this->twig->render($name, $this->getParameterBag()->getAll());
        $current = (string)$this->getParameterBag()->get('response')->getBody();

        $matcher = (new SimpleFactory())->createMatcher();

        if (!$matcher->match($current, $expected)) {
            throw new \Exception($matcher->getError());
        }
    }
}
