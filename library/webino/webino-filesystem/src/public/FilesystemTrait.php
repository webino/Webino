<?php

namespace Webino;

use Webino\Filesystem\LocalNode;

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

    private function getFilesystemItem(string $path, string $type)
    {
        $fsPath = new FilesystemPath($path);

        $filesystem = $this->getFilesystem();
        $scheme = $fsPath->getScheme($filesystem->getDefaultFileScheme());
        $isAbsoluteClass = ('\\' == $scheme[0]);

        if ($isAbsoluteClass) {
            $class = $scheme;
        } else {
            $aliases = $filesystem->getFileSchemeAliases();
            $name = $aliases[$scheme] ?? $scheme;
            $class = sprintf('\Webino\\Filesystem\\%s%s', ucfirst($name), $type);
        }

        // TODO catch exceptions

        if (!class_exists($class)) {
            $class = sprintf('\Webino\\Filesystem\\%s%s', 'Local', $type);
            return $this->create($class, $path, clone $this);
        }

        try {
            return $this->create($class, $fsPath->getPathName(), clone $this);
        } catch (\Throwable $exc) {
            // TODO exception
//            var_dump(class_exists(LocalNode::class));
            die('Cant get filesystem node for path ' . $path);
        }
    }

    /**
     * Returns required node object for path
     *
     * @param string $path
     * @return FilesystemNodeInterface
     */
    function getNode(string $path): FilesystemNodeInterface
    {
        return $this->getFilesystemItem($path, 'Node');
    }

    /**
     * Returns required file object for path
     *
     * @param string $filePath
     * @return FilesystemFileInterface
     */
    function getFile(string $filePath): FilesystemFileInterface
    {
        return $this->getFilesystemItem($filePath, 'File');
    }

    /**
     * Returns iterable file list for path
     *
     * @param string $dirPath
     * @return FilesystemFileListInterface
     */
    function getFileList(string $dirPath): FilesystemFileListInterface
    {
        return $this->getFilesystemItem($dirPath, 'FileList');
    }
}
