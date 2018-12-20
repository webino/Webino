<?php

namespace Webino;

/**
 * Trait FilesystemTrait
 * @package webino-filesystem
 */
trait FilesystemTrait
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * Creates new instance
     *
     * @param string $class Instance class
     * @param array $parameter Optional parameters
     * @throws InstanceNotFoundException No entry was found for identifier
     * @throws InstanceContainerException Error while retrieving the entry
     * @return mixed New instance
     */
    abstract function create(string $class, ...$parameter);

    /**
     * @return Filesystem
     */
    function getFilesystem(): Filesystem
    {
        $this->filesystem or $this->filesystem = $this->create(Filesystem::class);
        return $this->filesystem;
    }

    /**
     * Returns required node object for path
     *
     * @param string $path
     * @return FilesystemNodeInterface
     */
    function getNode(string $path): FilesystemNodeInterface
    {
        $path = new FilesystemPath($path);

        $filesystem = $this->getFilesystem();
        $scheme = $path->getScheme($filesystem->getDefaultFileScheme());
        $isAbsoluteClass = ('\\' == $scheme[0]);

        if ($isAbsoluteClass) {
            $class = $scheme;
        } else {
            $aliases = $filesystem->getFileSchemeAliases();
            $name = $aliases[$scheme] ?? $scheme;
            $class = sprintf('\Webino\\Filesystem\\%sNode', ucfirst($name));
        }

        // TODO catch exceptions
        return $this->create($class, $path->getPathName(), clone $this);
    }

    /**
     * Returns required file object for path
     *
     * @param string $filePath
     * @return FilesystemFileInterface
     */
    function getFile(string $filePath): FilesystemFileInterface
    {
        $path = new FilesystemPath($filePath);

        $filesystem = $this->getFilesystem();
        $scheme = $path->getScheme($filesystem->getDefaultFileScheme());
        $isAbsoluteClass = ('\\' == $scheme[0]);

        if ($isAbsoluteClass) {
            $class = $scheme;
        } else {
            $aliases = $filesystem->getFileSchemeAliases();
            $name = $aliases[$scheme] ?? $scheme;
            $class = sprintf('\Webino\\Filesystem\\%sFile', ucfirst($name));
        }

        // TODO catch exceptions
        return $this->create($class, $path->getPathName(), clone $this);
    }

    /**
     * Returns iterable file list for path
     *
     * @param string $dirPath
     * @return FilesystemFileListInterface
     */
    function getFileList(string $dirPath): FilesystemFileListInterface
    {
        $path = new FilesystemPath($dirPath);

        $filesystem = $this->getFilesystem();
        $scheme = $path->getScheme($filesystem->getDefaultFileScheme());
        $isAbsoluteClass = ('\\' == $scheme[0]);

        if ($isAbsoluteClass) {
            $class = $scheme;
        } else {
            $aliases = $filesystem->getFileSchemeAliases();
            $name = $aliases[$scheme] ?? $scheme;
            $class = sprintf('\Webino\\Filesystem\\%sFileList', ucfirst($name));
        }

        return $this->create($class, $path->getPathName(), clone $this);
    }
}
