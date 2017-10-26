<?php

namespace WebinoAppLib\Contract;

/**
 * Interface FilesystemInterface
 */
interface FilesInterface
{
    /**
     * @return \BsbFlysystem\Service\FilesystemManager
     */
    public function getFiles();

    /**
     * @param string $adapter Filesystem adapter name
     * @return \WebinoFilesystemLib\Filesystem\FilesystemInterface
     */
    public function file($adapter = null);
}
