<?php

namespace Webino;

/**
 * Interface FilesystemFileInterface
 * @package webino-filesystem
 */
interface FilesystemFileInterface extends FilesystemNodeInterface
{
    /**
     * Returns file contents
     *
     * @return string
     */
    function getContents(): string;
}
