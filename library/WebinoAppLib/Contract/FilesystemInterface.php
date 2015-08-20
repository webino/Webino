<?php

namespace WebinoAppLib\Contract;

/**
 * Interface FilesystemInterface
 */
interface FilesystemInterface
{
    /**
     * @return \BsbFlysystem\Service\FilesystemManager|mixed
     */
    public function getFilesystems();

    /**
     * @param string $adapter Filesystem adapter name
     * @return \WebinoFilesystemLib\Filesystem\FilesystemInterface
     */
    public function file($adapter = null);
}
