<?php

namespace Webino\Filesystem;

/**
 * Class SystemFileList
 * @package webino-system
 */
class SystemFileList extends AbstractFileList
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
