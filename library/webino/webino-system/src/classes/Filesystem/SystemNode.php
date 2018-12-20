<?php

namespace Webino\Filesystem;

/**
 * Class SystemNode
 * @package webino-system
 */
class SystemNode extends AbstractNode
{
    /**
     * @param string $path
     * @param mixed ...$parameter
     */
    function __construct(string $path, ...$parameter)
    {
        parent::__construct("../system/{$path}", ...$parameter);
    }
}
