<?php

namespace Webino\Filesystem;

/**
 * Class SystemFile
 * @package webino-system
 */
class SystemFile extends AbstractFile
{
    /**
     * @param string $path
     * @param mixed ...$parameter
     */
    function __construct(string $path, ...$parameter)
    {
        parent::__construct("system://{$path}", ...$parameter);
    }
}
