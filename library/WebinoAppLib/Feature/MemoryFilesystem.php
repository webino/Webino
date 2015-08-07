<?php

namespace WebinoAppLib\Feature;

use WebinoAppLib\Filesystem\InMemoryFiles;
use WebinoFilesystemLib\Feature\MemoryFilesystem as BaseMemoryFilesystem;

/**
 * Class MemoryFilesystem
 */
class MemoryFilesystem extends BaseMemoryFilesystem
{
    /**
     * Configure application memory filesystem
     */
    public function __construct()
    {
        parent::__construct(InMemoryFiles::class);
    }
}
