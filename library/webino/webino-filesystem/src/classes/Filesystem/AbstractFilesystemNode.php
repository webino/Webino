<?php

namespace Webino\Filesystem;

use Webino\FilesystemFileInterface;
use Webino\FilesystemInterface;
use Webino\FilesystemNodeInterface;

/**
 * Class AbstractFilesystemNode
 * @package webino-filesystem
 */
abstract class AbstractFilesystemNode implements FilesystemNodeInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var FilesystemInterface
     */
    private $filesystem;

    /**
     * @param string $path
     * @param FilesystemInterface $filesystem
     */
    function __construct(string $path, FilesystemInterface $filesystem)
    {
        $this->path = $path;
        $this->filesystem = $filesystem;
    }

    /**
     * Returns file path
     *
     * @return string
     */
    function getPath(): string
    {
        return $this->path;
    }

    /**
     * Returns owning filesystem
     *
     * @return FilesystemInterface
     */
    function getFilesystem(): FilesystemInterface
    {
        return $this->filesystem;
    }

    /**
     * Returns path name
     *
     * e.g.: foo/bar/(baz).txt
     *
     * @return string
     */
    function getName()
    {
        return pathinfo($this->getPath(), PATHINFO_FILENAME);
    }

    /**
     * Returns path extension
     *
     * e.g.: foo/bar/baz.(txt)
     *
     * @return string
     */
    function getExtension()
    {
        return pathinfo($this->getPath(), PATHINFO_EXTENSION);
    }

    /**
     * Returns path base name
     *
     * e.g.: foo/bar/(baz.txt)
     *
     * @return string
     */
    function getBaseName()
    {
        return pathinfo($this->getPath(), PATHINFO_BASENAME);
    }

    /**
     * Return filesystem node as file
     *
     * @return FilesystemFileInterface
     */
    function asFile(): FilesystemFileInterface
    {
        return $this instanceof FilesystemFileInterface ? $this : null;
    }
}
