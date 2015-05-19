<?php
namespace Surgun9\GoogleApiBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * GoogleApiExtension
 *
 * @author Serghei Luchianenco <serge@luchianenco.com>
 */
class GoogleApiExtension extends Extension
{
    /**
     * @param array $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter(
            'google_api.service.client_id',
            $config['google_service']['client_id']
        );
        $container->setParameter(
            'google_api.service.service_email',
            $config['google_service']['service_email']
        );
        $container->setParameter(
            'google_api.service.key_file',
            $config['google_service']['key_file']
        );
        $container->setParameter(
            'google_api.service.scope',
            $config['google_service']['scope']
        );
    }
}
