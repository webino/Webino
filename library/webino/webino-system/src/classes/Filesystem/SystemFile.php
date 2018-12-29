<?php

namespace Webino\Filesystem;

/**
 * Class SystemFile
 * @package webino-system
 */
final class SystemFile extends AbstractFile
{
    use AbstractFilesystemTrait;

    /**
     * Target filesystem scheme
     */
    const SCHEME = 'system';
}
