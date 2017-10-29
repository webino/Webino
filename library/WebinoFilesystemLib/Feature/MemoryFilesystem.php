<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoFilesystemLib\Feature;

use League\Flysystem\Memory\MemoryAdapter;

/**
 * Class MemoryFilesystem
 */
class MemoryFilesystem extends AbstractFilesystem
{
    /**
     * Filesystem type
     */
    const TYPE = 'memory';

    /**
     * Configure a memory filesystem
     *
     * @param string $name Filesystem name
     */
    public function __construct($name)
    {
        parent::__construct();

        $this
            ->configureAdapter($name, self::TYPE)
            ->configureFilesystem($name, $name)
            ->configureAdapterMapInvokable(self::TYPE, MemoryAdapter::class);
    }
}
