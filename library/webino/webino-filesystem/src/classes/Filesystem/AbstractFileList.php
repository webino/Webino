<?php

namespace Webino\Filesystem;

/**
 * Class AbstractFileList
 * @package webino-filesystem
 */
abstract class AbstractFileList extends AbstractFilesystemFileList implements \IteratorAggregate
{
    /**
     * @return \Iterator
     */
    function getIterator(): \Iterator
    {
        $filesystem = $this->getFilesystem();
        foreach ($filesystem->getFileList($filesystem->getNode($this->getPath())->getPath()) as $item) {
            yield $item;
        }
    }
}
