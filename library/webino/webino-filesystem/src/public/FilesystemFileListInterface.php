<?php

namespace Webino;

/**
 * Interface FilesystemFileListInterface
 * @package webino-filesystem
 */
interface FilesystemFileListInterface
{
    /**
     * Iterate only regular expression pattern matches
     *
     * @param string $regex Regular expression (with delimiters)
     * @return FilesystemNodeInterface[]|\Iterator
     */
    function forRegex(string $regex): \Iterator;

    /**
     * Iterate only matching extension
     *
     * @param string ...$extension File extension
     * @return FilesystemNodeInterface[]|\Iterator
     */
    function withExtension(...$extension): \Iterator;
}
