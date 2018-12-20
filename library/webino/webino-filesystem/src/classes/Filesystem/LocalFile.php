<?php

namespace Webino\Filesystem;

/**
 * Class LocalFile
 * @package webino-filesystem
 */
class LocalFile extends AbstractFilesystemFile
{
    /**
     * Returns file contents
     *
     * @return string
     */
    function getContents(): string
    {
        return file_get_contents($this->getPath());
    }
}
