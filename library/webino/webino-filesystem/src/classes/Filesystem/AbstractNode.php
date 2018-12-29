<?php

namespace Webino\Filesystem;

/**
 * Class AbstractNode
 * @package webino-filesystem
 */
abstract class AbstractNode extends AbstractFilesystemNode
{
    /**
     * Returns file contents
     *
     * @return string
     */
    function getPath(): string
    {
        return $this->getFilesystem()->getNode(parent::getPath())->getPath();
    }

    /**
     * Return filesystem node real path
     *
     * @return string
     */
    function getRealPath(): string
    {
        return $this->getFilesystem()->getNode(parent::getPath())->getRealPath();
    }

    /**
     * Returns true when filesystem node exists
     *
     * @return bool
     */
    function exists(): bool
    {
        return $this->getFilesystem()->getNode(parent::getPath())->exists();
    }
}
