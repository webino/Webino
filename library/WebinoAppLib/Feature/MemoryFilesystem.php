<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
