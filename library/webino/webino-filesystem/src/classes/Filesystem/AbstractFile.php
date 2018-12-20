<?php

namespace Webino\Filesystem;

/**
 * Class AbstractFile
 * @package webino-filesystem
 */
abstract class AbstractFile extends AbstractFilesystemFile
{
    /**
     * Returns file contents
     *
     * @return string
     */
    function getContents(): string
    {
        $filesystem = $this->getFilesystem();
        return $filesystem->getFile($filesystem->getNode($this->getPath())->getPath())->getContents();
    }
}
