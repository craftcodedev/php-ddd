<?php


namespace App\Shared\Infrastructure\Symfony\config;


namespace App\Shared\Infrastructure\Symfony\config;

final class ConfigFileSearcher
{
    const FILE_TYPE_ROUTE = 'route';
    const FILE_TYPE_SERVICE = 'services';

    public function searchByTypeIn(string $type, string $path) {
        $files = scandir($path);
        $fileCollection = [];

        foreach ($files as $key => $value) {
            $file = $files[$key];

            if ($file === '.' || $file === '..') {
                continue;
            }

            $currentPath = $path.'/'.$file;

            if ($file === 'Infrastructure') {
                if ($type === self::FILE_TYPE_ROUTE) {
                    $fileConfig = $currentPath.'/Symfony/config/routes.yaml';

                    if (file_exists($fileConfig)) {
                        $fileCollection[] = $fileConfig;
                    }

                    return $fileCollection;
                }

                if ($type === self::FILE_TYPE_SERVICE) {
                    $fileConfig = $currentPath . '/Symfony/config/application_services.yaml';

                    if (file_exists($fileConfig)) {
                        $fileCollection[] = $fileConfig;
                    }

                    $fileConfig = $currentPath . '/Symfony/config/domain_services.yaml';

                    if (file_exists($fileConfig)) {
                        $fileCollection[] = $fileConfig;
                    }

                    $fileConfig = $currentPath . '/Symfony/config/infrastructure_services.yaml';

                    if (file_exists($fileConfig)) {
                        $fileCollection[] = $fileConfig;
                    }

                    $fileConfig = $currentPath . '/Symfony/config/ui_services.yaml';

                    if (file_exists($fileConfig)) {
                        $fileCollection[] = $fileConfig;
                    }

                    return $fileCollection;
                }
            }

            if (is_dir($currentPath)) {
                $fileCollection = array_merge($fileCollection, $this->searchByTypeIn($type, $currentPath));
            }
        }

        return $fileCollection;
    }
}