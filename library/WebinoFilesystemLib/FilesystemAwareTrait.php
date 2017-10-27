<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
