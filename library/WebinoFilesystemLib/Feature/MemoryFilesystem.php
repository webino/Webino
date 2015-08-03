<?php

namespace WebinoFilesystemLib\Feature;

use League\Flysystem\Memory\MemoryAdapter;

/**
 * Class MemoryFilesystem
 */
class MemoryFilesystem extends AbstractFilesystem
{
    /**
     * Filesystem type
     */
    const TYPE = 'memory';

    /**
     * Configure a memory filesystem
     *
     * @param string $name Filesystem name
     */
    public function __construct($name)
    {
        $this
            ->configureAdapter($name, self::TYPE)
            ->configureFilesystem($name, $name)
            ->configureAdapterMapInvokable(self::TYPE, MemoryAdapter::class);
    }
}
