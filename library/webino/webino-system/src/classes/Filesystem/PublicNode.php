<?php

namespace Webino\Filesystem;

/**
 * Class PublicNode
 * @package webino-system
 */
final class PublicNode extends AbstractNode
{
    /**
     * @param string $path
     * @param mixed ...$parameter
     */
    function __construct(string $path, ...$parameter)
    {
        parent::__construct("./{$path}", ...$parameter);
    }
}
