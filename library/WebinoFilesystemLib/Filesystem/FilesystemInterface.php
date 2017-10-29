<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoFilesystemLib\Filesystem;

use League\Flysystem\FilesystemInterface as BaseFilesystemInterface;

/**
 * Interface FilesystemInterface
 */
interface FilesystemInterface extends BaseFilesystemInterface
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
