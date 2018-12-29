<?php

namespace Webino\Filesystem;

/**
 * Trait AbstractFilesystemTrait
 * @package webino-filesystem
 */
trait AbstractFilesystemTrait
{
    /**
     * @param string $path
     * @param mixed ...$parameter
     */
    function __construct(string $path, ...$parameter)
    {
        parent::__construct($this::SCHEME . "://{$path}", ...$parameter);
    }
}
