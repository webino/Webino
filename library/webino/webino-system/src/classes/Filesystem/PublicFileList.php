<?php

namespace Webino\Filesystem;

/**
 * Class PublicFileList
 * @package webino-system
 */
final class PublicFileList extends AbstractFileList
{
    use AbstractFilesystemTrait;

    /**
     * Target filesystem scheme
     */
    const SCHEME = 'public';
}
