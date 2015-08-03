<?php

namespace WebinoAppLib\Contract;

/**
 * Interface FilesystemInterface
 */
interface FilesystemInterface
{
    /**
     * @param string $adapter Filesystem adapter name
     * @return \WebinoFilesystemLib\Filesystem\FilesystemInterface
     */
    public function file($adapter = null);
}
