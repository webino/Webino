<?php

namespace Webino\Filesystem;

/**
 * Class CacheFileList
 * @package webino-system
 */
final class CacheFileList extends AbstractFileList
{
    use AbstractFilesystemTrait;

    /**
     * Target filesystem scheme
     */
    const SCHEME = 'cache';
}
