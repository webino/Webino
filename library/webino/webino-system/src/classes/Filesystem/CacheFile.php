<?php

namespace Webino\Filesystem;

/**
 * Class CacheFile
 * @package webino-system
 */
final class CacheFile extends AbstractFile
{
    use AbstractFilesystemTrait;

    /**
     * Target filesystem scheme
     */
    const SCHEME = 'cache';
}
