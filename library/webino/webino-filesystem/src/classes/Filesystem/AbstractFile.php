<?php

namespace Webino\Filesystem;

/**
 * Class AbstractFile
 * @package webino-filesystem
 */
abstract class AbstractFile extends AbstractFilesystemFile
{
    /**
     * Return filesystem node real path
     *
     * @return string
     */
    function getRealPath(): string
    {
        $filesystem = $this->getFilesystem();
        return $filesystem->getFileList($filesystem->getNode($this->getPath())->getPath())->getRealPath();
    }

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

    /**
     * Sets file contents
     *
     * @param string $fileContents
     */
    function setContents(string $fileContents): void
    {
        $filesystem = $this->getFilesystem();
        $filesystem->getFile($filesystem->getNode($this->getPath())->getPath())->setContents($fileContents);
    }

    /**
     * Returns file integrity hash
     *
     * @see https://www.w3.org/TR/SRI/
     * @return string
     */
    function getIntegrity(): string
    {
        $filesystem = $this->getFilesystem();
        return $filesystem->getFile($filesystem->getNode($this->getPath())->getPath())->getIntegrity();
    }

    /**
     * Returns true when filesystem node exists
     *
     * @return bool
     */
    function exists(): bool
    {
        $filesystem = $this->getFilesystem();
        return $filesystem->getFile($filesystem->getNode($this->getPath())->getPath())->exists();
    }
}
