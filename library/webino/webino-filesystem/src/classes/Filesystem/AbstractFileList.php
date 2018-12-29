<?php

namespace Webino\Filesystem;

/**
 * Class AbstractFileList
 * @package webino-filesystem
 */
abstract class AbstractFileList extends AbstractFilesystemFileList implements \IteratorAggregate
{
    /**
     * Return filesystem node real path
     *
     * @return string
     */
    function getRealPath(): string
    {
        $filesystem = $this->getFilesystem();
        return $filesystem->getFileList($filesystem->getNode($this->getPath())->getPath())->getRealPath();
    }

    /**
     * Returns true when filesystem node exists
     *
     * @return bool
     */
    function exists(): bool
    {
        $filesystem = $this->getFilesystem();
        return $filesystem->getFileList($filesystem->getNode($this->getPath())->getPath())->exists();
    }

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
