<?php

namespace Webino\Filesystem;

use Webino\FilesystemFileInterface;

/**
 * Class AbstractFilesystemFile
 * @package webino-filesystem
 */
abstract class AbstractFilesystemFile extends AbstractFilesystemNode implements FilesystemFileInterface
{
    /**
     * @return string
     */
    function __toString(): string
    {
        return $this->getPath();
    }

    /**
     * Returns file contents
     *
     * @return string
     */
    abstract function getContents(): string;

    /**
     * Sets file contents
     *
     * @param string $fileContents
     */
    abstract function setContents(string $fileContents): void;

    /**
     * Returns file integrity hash
     *
     * @return string
     */
    abstract function getIntegrity(): string;
}
