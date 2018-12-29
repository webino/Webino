<?php

namespace Webino;

/**
 * Interface FilesystemNodeInterface
 * @package webino-filesystem
 */
interface FilesystemNodeInterface
{
    /**
     * Return filesystem node path
     *
     * @return string
     */
    function getPath(): string;

    /**
     * Return filesystem node real path
     *
     * @return string
     */
    function getRealPath(): string;

    /**
     * Returns path name
     *
     * e.g.: foo/bar/(baz).txt
     *
     * @return string
     */
    function getName(): string;

    /**
     * Returns path extension
     *
     * e.g.: foo/bar/baz.(txt)
     *
     * @return string
     */
    function getExtension(): string;

    /**
     * Returns path base name
     *
     * e.g.: foo/bar/(baz.txt)
     *
     * @return string
     */
    function getBaseName(): string;

    /**
     * Returns true when filesystem node exists
     *
     * @return bool
     */
    function exists(): bool;

    /**
     * Return filesystem node as file
     *
     * @return FilesystemFileInterface
     */
    function asFile(): FilesystemFileInterface;
}
