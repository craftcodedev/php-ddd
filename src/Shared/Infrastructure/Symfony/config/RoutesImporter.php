<?php


namespace App\Shared\Infrastructure\Symfony\config;

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

final class RoutesImporter implements SymfonyConfigImporterInterface
{
    public function __construct(private ConfigFileSearcher $searcher, private RoutingConfigurator $routes)
    {
    }

    public function __invoke(string $path)
    {
        $files = $this->searcher->searchByTypeIn(ConfigFileSearcher::FILE_TYPE_ROUTE, $path);

        foreach ($files as $file) {
            $resultRout = $this->routes->import($file);
            $resultRout->prefix('/api/v1');
        }
    }
}