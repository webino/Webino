<?php

namespace WebinoAppLib\Feature;

use WebinoAppLib\Filesystem\InMemoryFiles;

/**
 * Class MemoryFilesystem
 */
class MemoryFilesystem extends \WebinoFilesystemLib\Feature\MemoryFilesystem
{
    /**
     * Configure an application memory filesystem
     *
     */
    public function __construct()
    {
        parent::__construct(InMemoryFiles::class);
    }
}
