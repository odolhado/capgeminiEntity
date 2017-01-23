<?php

namespace AppBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('core');

//        $rootNode
//            ->children()
//            ->scalarNode('medatada_dir')
//            ->defaultValue(__DIR__.'/../Resources/config/serializer')
//            ->end()
//            ->end()
//        ;

        return $treeBuilder;
    }
}