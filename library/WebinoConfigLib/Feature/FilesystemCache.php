<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoConfigLib\Feature;

use WebinoConfigLib\Cache\Filesystem;

/**
 * Class FilesystemCache
 */
class FilesystemCache extends AbstractCache
{
    /**
     * @param string|null $namespace
     * @param string|null $dir
     */
    public function __construct($namespace = null, $dir = null)
    {
        $cache = new Filesystem($this->resolveNamespace($namespace), $dir);
        parent::__construct([[$this::KEY => $cache->toArray()]]);
    }
}
