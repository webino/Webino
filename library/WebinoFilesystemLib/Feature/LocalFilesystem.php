<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoFilesystemLib\Feature;

/**
 * Class LocalFilesystem
 */
class LocalFilesystem extends AbstractFilesystem
{
    /**
     * Filesystem type
     */
    const TYPE = 'local';

    /**
     * Configure a local filesystem
     *
     * @param string $name Filesystem name
     * @param string $root Root path
     */
    public function __construct($name, $root = '.')
    {
        parent::__construct();
        $this->configureAdapter($name, self::TYPE, ['root' => $root]);
        $this->configureFilesystem($name, $name);
    }
}
