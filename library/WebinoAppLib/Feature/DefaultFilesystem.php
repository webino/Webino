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
     * @param string $root
     */
    public function __construct($root = '.')
    {
        parent::__construct(LocalFiles::class, $root);
    }
}
