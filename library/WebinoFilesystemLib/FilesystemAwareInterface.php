<?php

namespace WebinoFilesystemLib;

use League\Flysystem\FilesystemInterface;

/**
 * Interface FilesystemAwareInterface
 */
interface FilesystemAwareInterface
{
    /**
     * Set logger instance
     *
     * @param FilesystemInterface $filesystem
     * @return $this
     */
    public function setFilesystem(FilesystemInterface $filesystem);
}
