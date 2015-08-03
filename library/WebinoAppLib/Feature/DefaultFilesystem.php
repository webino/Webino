<?php

namespace WebinoAppLib\Feature;

use WebinoAppLib\Filesystem\LocalFiles;
use WebinoFilesystemLib\Feature\LocalFilesystem;

/**
 * Class DefaultFilesystem
 */
class DefaultFilesystem extends LocalFilesystem
{
    /**
     * Configure an application default filesystem
     *
     * @param $root
     */
    public function __construct($root = '.')
    {
        parent::__construct(LocalFiles::class, $root);
    }
}
