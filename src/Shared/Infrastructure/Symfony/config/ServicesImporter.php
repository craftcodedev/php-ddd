<?php


namespace App\Shared\Infrastructure\Symfony\config;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

final class ServicesImporter implements SymfonyConfigImporterInterface
{
    public function __construct(private ConfigFileSearcher $searcher, private ContainerConfigurator $container)
    {
    }

    public function __invoke(string $path)
    {
        $files = $this->searcher->searchByTypeIn(ConfigFileSearcher::FILE_TYPE_SERVICE, $path);

        foreach ($files as $file) {
            $this->container->import($file);
        }
    }
}