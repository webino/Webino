<?php

namespace Webino\Filesystem;

use Webino\FilesystemFileListInterface;

/**
 * Class AbstractFilesystemFileList
 * @package webino-filesystem
 */
abstract class AbstractFilesystemFileList extends AbstractFilesystemNode implements FilesystemFileListInterface
{
    /**
     * @return \Iterator
     */
    abstract function getIterator(): \Iterator;

    /**
     * Iterate only regular expression pattern matches
     *
     * @param string $regex Regular expression (with delimiters)
     * @return \Iterator
     */
    function forRegex(string $regex): \Iterator
    {
        return new \RegexIterator($this->getIterator(), $regex);
    }

    /**
     * Iterate only matching extension
     *
     * @param string ...$extension File extension
     * @return \Iterator
     */
    function withExtension(...$extension): \Iterator
    {
        $parts = [];
        foreach ($extension as $ext) {
            $parts[] = '\.' . preg_quote($ext);
        }

        return $this->forRegex(sprintf('~%s~', join('|', $parts)));
    }
}
