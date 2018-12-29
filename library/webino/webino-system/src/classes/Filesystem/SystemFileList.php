<?php

namespace Webino\Filesystem;

/**
 * Class SystemFileList
 * @package webino-system
 */
final class SystemFileList extends AbstractFileList
{
    use AbstractFilesystemTrait;

    /**
     * Target filesystem scheme
     */
    const SCHEME = 'system';
}
