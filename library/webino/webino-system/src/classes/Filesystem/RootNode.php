<?php

namespace Webino\Filesystem;

/**
 * Class RootNode
 * @package webino-system
 */
final class RootNode extends AbstractNode
{
    /**
     * @param string $path
     * @param mixed ...$parameter
     */
    function __construct(string $path, ...$parameter)
    {
        parent::__construct("../{$path}", ...$parameter);
    }
}
