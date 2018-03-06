<?php
namespace Kwf\KwcNativeMenuBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

class KwfKwcNativeMenuExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $def = $container->getDefinition('kwf_kwcnativemenu.components');
        $def->addMethodCall('setReturnedLevels', array('returnedLevels' => $config['returnedLevels']));

        $def = $container->getDefinition('kwf_kwcnativemenu.menu_controller');
        $def->addMethodCall('setRootComponentId', array('rootComponentId' => $config['rootComponentId']));
    }
}
