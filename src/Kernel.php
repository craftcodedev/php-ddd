<?php

namespace App;

use App\Shared\Infrastructure\Symfony\config\ConfigFileSearcher;
use App\Shared\Infrastructure\Symfony\config\RoutesImporter;
use App\Shared\Infrastructure\Symfony\config\ServicesImporter;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('../config/{packages}/*.yaml');
        $container->import('../config/{packages}/' . $this->environment . '/*.yaml');

        if (is_file(\dirname(__DIR__) . '/config/services.yaml')) {
            $container->import('../config/services.yaml');
            $container->import('../config/{services}_' . $this->environment . '.yaml');
        } else {
            $container->import('../config/{services}.php');
        }

        $root = $this->getProjectDir() . '/src';
        $configFileRepository = new ConfigFileSearcher();
        $routesImporter = new ServicesImporter($configFileRepository, $container);
        $routesImporter->__invoke($root);
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import('../config/{routes}/' . $this->environment . '/*.yaml');
        $routes->import('../config/{routes}/*.yaml');

        if (is_file(\dirname(__DIR__) . '/config/routes.yaml')) {
            $routes->import('../config/routes.yaml');
        } else {
            $routes->import('../config/{routes}.php');
        }

        $root = $this->getProjectDir() . '/src';
        $configFileRepository = new ConfigFileSearcher();
        $routesImporter = new RoutesImporter($configFileRepository, $routes);
        $routesImporter->__invoke($root);
    }
}
