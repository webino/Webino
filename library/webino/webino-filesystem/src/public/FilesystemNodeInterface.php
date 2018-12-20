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
     * Returns path name
     *
     * e.g.: foo/bar/(baz).txt
     *
     * @return string
     */
    function getName();

    /**
     * Returns path extension
     *
     * e.g.: foo/bar/baz.(txt)
     *
     * @return string
     */
    function getExtension();

    /**
     * Returns path base name
     *
     * e.g.: foo/bar/(baz.txt)
     *
     * @return string
     */
    function getBaseName();

    /**
     * Return filesystem node as file
     *
     * @return FilesystemFileInterface
     */
    function asFile(): FilesystemFileInterface;
}
