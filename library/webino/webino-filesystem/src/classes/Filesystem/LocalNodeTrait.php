<?php

namespace Webino\Filesystem;

/**
 * Trait LocalNodeTrait
 * @package webino-filesystem
 */
trait LocalNodeTrait
{
    /**
     * Return filesystem node real path
     *
     * @return string
     */
    function getRealPath(): string
    {
        return $this->getPath();
    }

    /**
     * Returns true when filesystem node exists
     *
     * @return bool
     */
    function exists(): bool
    {
        return file_exists($this->getPath());
    }
}
