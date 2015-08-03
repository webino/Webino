<?php

namespace WebinoFilesystemLib\Filesystem;

/**
 * Interface FilesystemInterface
 */
interface FilesystemInterface extends \League\Flysystem\FilesystemInterface
{
    /**
     * List all paths.
     *
     * @see \League\Flysystem\Plugin\EmptyDir
     * @param string $directory Path to directory.
     */
    public function emptyDir($directory);

    /**
     * List all paths.
     *
     * @see \League\Flysystem\Plugin\ListPaths
     * @param string $directory Path to directory.
     * @param bool $recursive
     * @return array Array of paths.
     */
    public function listPaths($directory, $recursive = false);

    /**
     * List all files in the directory.
     *
     * @see \League\Flysystem\Plugin\ListFiles
     * @param string $directory
     * @param bool $recursive
     * @return array
     */
    public function listFiles($directory, $recursive = false);
}
