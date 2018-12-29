<?php

namespace Webino\Filesystem;

/**
 * Class PublicFile
 * @package webino-system
 */
final class PublicFile extends AbstractFile
{
    use AbstractFilesystemTrait;

    /**
     * Target filesystem scheme
     */
    const SCHEME = 'public';
}
