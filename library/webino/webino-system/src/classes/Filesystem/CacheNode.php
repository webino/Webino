<?php

namespace Webino\Filesystem;

/**
 * Class CacheNode
 * @package webino-system
 */
final class CacheNode extends AbstractNode
{
    /**
     * @param string $path
     * @param mixed ...$parameter
     */
    function __construct(string $path, ...$parameter)
    {
        parent::__construct("root://cache/{$path}", ...$parameter);
    }
}
