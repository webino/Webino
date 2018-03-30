<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Config\Feature;

/**
 * Class AbstractCache
 */
abstract class AbstractCache extends AbstractFeature
{
    /**
     * Application configuration key
     */
    const KEY = 'cache';

    /**
     * Cache namespace
     */
    const DEFAULT_NAMESPACE = 'application';

    /**
     * @param string $namespace
     * @return string
     */
    protected function resolveNamespace($namespace) : string
    {
        return is_null($namespace) ? self::DEFAULT_NAMESPACE : $namespace;
    }
}
