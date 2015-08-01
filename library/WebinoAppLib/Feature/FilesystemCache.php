<?php

namespace WebinoAppLib\Feature;

use WebinoAppLib\Application;
use WebinoConfigLib\Feature\FilesystemCache as Engine;

/**
 * Class FilesystemCache
 */
class FilesystemCache extends AbstractCache
{
    /**
     * Configure an application cache
     */
    public function __construct()
    {
        parent::__construct();
        $this->mergeArray((new Engine)->toArray());
    }
}
