<?php

namespace WebinoFilesystemLib\Feature;

use League\Flysystem\Plugin\EmptyDir;
use League\Flysystem\Plugin\ListFiles;
use League\Flysystem\Plugin\ListPaths;
use WebinoConfigLib\Feature\AbstractFeature;

/**
 * Class AbstractFilesystem
 */
abstract class AbstractFilesystem extends AbstractFeature
{
    /**
     * Application config key
     */
    const FILESYSTEM = 'bsb_flysystem';

    /**
     * Base filesystem plugins
     *
     * @var array
     */
    private $basePlugins = [EmptyDir::class, ListPaths::class, ListFiles::class];

    /**
     * @param string $name Name of adapter service.
     * @param string $type
     * @param array $options
     * @return self
     */
    protected function configureAdapter($name, $type, array $options = [])
    {
        $this->mergeArray([
            $this::FILESYSTEM => [
                'adapters' => [
                    $name => [
                        'type'    => $type,
                        'options' => $options,
                    ],
                ],
            ]
        ]);

        return $this;
    }

    /**
     * @param string $name Name of filesystem.
     * @param string $adapter Name of adapter service.
     * @param string|bool $cache If defined as string it should be a name of a service present in the main service
     *                           locator. Defaults to false.
     * @param string|bool $eventable When true returns an EventableFilesystem instance.
     * @param array $plugins List of FQCN to the plugin you wish to register for this filesystem.
     * @return self
     */
    protected function configureFilesystem($name, $adapter, $cache = false, $eventable = false, array $plugins = [])
    {
        $this->mergeArray([
            $this::FILESYSTEM => [
                'filesystems' => [
                    $name => [
                        'adapter'   => $adapter,
                        'cache'     => $cache,
                        'eventable' => $eventable,
                        'plugins'   => array_merge($this->basePlugins, $plugins),
                    ],
                ],
            ]
        ]);

        return $this;
    }

    /**
     * @param array $options
     * @return self
     */
    private function configureAdapterMap(array $options)
    {
        $this->mergeArray([$this::FILESYSTEM => ['adapter_map' => $options]]);
        return $this;
    }

    /**
     * @param string $name Adapter name
     * @param string $class Invokable adapter class
     * @return self
     */
    protected function configureAdapterMapInvokable($name, $class)
    {
        $this->configureAdapterMap(['invokables' => [$name => $class]]);
        return $this;
    }
}