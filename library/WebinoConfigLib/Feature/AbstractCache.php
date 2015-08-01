<?php

namespace WebinoConfigLib\Feature;

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
    protected function resolveNamespace($namespace)
    {
        return is_null($namespace) ? self::DEFAULT_NAMESPACE : $namespace;
    }
}
