<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Dev\Filesystem;

use org\bovigo\vfs\vfsStreamDirectory;

/**
 * Class VirtualFilesystem
 */
class VirtualFilesystem
{
    /**
     * @param array $structure Directory structure
     */
    public function __construct(array $structure = [])
    {
        VirtualFilesystem\StreamWrapper::register();
        VirtualFilesystem\StreamWrapper::setRoot($this->setup($structure));
    }

    /**
     * @return void
     */
    public function __destruct()
    {
        VirtualFilesystem\StreamWrapper::unregister();
    }

    /**
     * Prepends the scheme to the given URL
     *
     * @param string $path
     * @return string
     */
    public function url($path) : string
    {
        return VirtualFilesystem\Stream::url($path);
    }

    /**
     * @param array $structure
     * @param null $permissions Root directory permissions
     * @param string $rootDirName Root directory name
     * @return vfsStreamDirectory
     */
    private function setup(array $structure = [], $permissions = null, $rootDirName = '/') : vfsStreamDirectory
    {
        return VirtualFilesystem\Stream::setup($rootDirName, $permissions, $structure);
    }
}
