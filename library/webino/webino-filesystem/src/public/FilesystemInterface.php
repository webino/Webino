<?php

namespace Webino;

/**
 * Interface FilesystemInterface
 * @package webino-filesystem
 */
interface FilesystemInterface
{
    /**
     * Get filesystem
     *
     * @return Filesystem
     */
    function getFilesystem(): Filesystem;

    /**
     * Returns required node object for path
     *
     * @param string $path
     * @return FilesystemNodeInterface
     */
    function getNode(string $path): FilesystemNodeInterface;

    /**
     * Returns required file object for path
     *
     * @param string $filePath
     * @return FilesystemFileInterface
     */
    function getFile(string $filePath): FilesystemFileInterface;

    /**
     * Returns directory file list
     *
     * @param string $dirPath
     * @return FilesystemNodeInterface[]|FilesystemFileListInterface
     */
    function getFileList(string $dirPath): FilesystemFileListInterface;
}
