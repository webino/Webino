<?php

namespace Webino\Filesystem;

/**
 * Class LogFileList
 * @package webino-system
 */
final class LogFileList extends AbstractFileList
{
    use AbstractFilesystemTrait;

    /**
     * Target filesystem scheme
     */
    const SCHEME = 'log';
}
