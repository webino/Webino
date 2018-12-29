<?php

namespace Webino\Filesystem;

/**
 * Class LogNode
 * @package webino-system
 */
final class LogNode extends AbstractNode
{
    /**
     * @param string $path
     * @param mixed ...$parameter
     */
    function __construct(string $path, ...$parameter)
    {
        parent::__construct("root://log/{$path}", ...$parameter);
    }
}
