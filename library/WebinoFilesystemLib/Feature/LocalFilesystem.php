<?php

namespace WebinoFilesystemLib\Feature;

/**
 * Class LocalFilesystem
 */
class LocalFilesystem extends AbstractFilesystem
{
    /**
     * Filesystem type
     */
    const TYPE = 'local';

    /**
     * Configure a local filesystem
     *
     * @param string $name Filesystem name
     * @param $root
     */
    public function __construct($name, $root = '.')
    {
        $this->configureAdapter($name, self::TYPE, ['root' => $root]);
        $this->configureFilesystem($name, $name);
    }
}
