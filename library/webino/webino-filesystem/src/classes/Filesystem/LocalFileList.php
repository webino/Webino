<?php

namespace Webino\Filesystem;

/**
 * Class LocalFileList
 * @package webino-filesystem
 */
class LocalFileList extends AbstractFilesystemFileList implements \IteratorAggregate
{
    /**
     * @return \Iterator
     */
    function getIterator(): \Iterator
    {
        foreach (new \DirectoryIterator($this->getPath()) as $item)
        {
            yield $this->getFilesystem()->getFile($item->getPathname());
        }
    }
}
