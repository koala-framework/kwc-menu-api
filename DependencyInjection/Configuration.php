<?php
namespace Kwf\KwcNativeMenuBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements \Symfony\Component\Config\Definition\ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('kwf_kwcnativemenu');
        $rootNode
            ->children()
                ->scalarNode('menuStartComponentId')->defaultValue('root')->end()
                ->integerNode('returnedLevels')->defaultValue(2)->end()
            ->end();
        return $treeBuilder;
    }
}
