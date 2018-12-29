<?php

namespace Webino;

/**
 * Interface FilesystemFileInterface
 * @package webino-filesystem
 */
interface FilesystemFileInterface extends FilesystemNodeInterface
{
    /**
     * Return filesystem node real path
     *
     * @return string
     */
    function getRealPath(): string;

    /**
     * Returns file contents
     *
     * @return string
     */
    function getContents(): string;

    /**
     * Sets file contents
     *
     * @param string $fileContents
     */
    function setContents(string $fileContents): void;

    /**
     * Returns file integrity hash
     *
     * @see https://www.w3.org/TR/SRI/
     * @return string
     */
    function getIntegrity(): string;
}
