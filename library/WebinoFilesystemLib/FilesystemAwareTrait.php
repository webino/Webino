<?php

namespace WebinoFilesystemLib;

use League\Flysystem\FilesystemInterface;

/**
 * Class FilesystemAwareTrait
 */
trait FilesystemAwareTrait
{
    /**
     * @var FilesystemInterface
     */
    private $filesystem = null;

    /**
     * Set filesystem object
     *
     * @param FilesystemInterface $filesystem
     * @return $this
     */
    public function setFilesystem(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
        return $this;
    }

    /**
     * Get filesystem object
     *
     * @return FilesystemInterface|\WebinoFilesystemLib\Filesystem\FilesystemInterface|null
     */
    protected function getFilesystem()
    {
        return $this->filesystem;
    }
}
