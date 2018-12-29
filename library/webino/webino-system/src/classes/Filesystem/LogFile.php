<?php

namespace Webino\Filesystem;

/**
 * Class LogFile
 * @package webino-system
 */
final class LogFile extends AbstractFile
{
    use AbstractFilesystemTrait;

    /**
     * Target filesystem scheme
     */
    const SCHEME = 'log';
}
