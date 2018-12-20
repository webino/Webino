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
}
