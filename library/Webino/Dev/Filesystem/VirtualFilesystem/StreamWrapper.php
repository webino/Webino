<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Dev\Filesystem\VirtualFilesystem;

use org\bovigo\vfs\vfsStreamWrapper;

/**
 * Extended virtual filesystem stream wrapper
 */
class StreamWrapper extends vfsStreamWrapper
{
    /**
     * {@inheritdoc}
     */
    public static function unregister() : void
    {
        self::$registered = false;

        in_array(Stream::SCHEME, stream_get_wrappers())
            and stream_wrapper_unregister(Stream::SCHEME);
    }
}
