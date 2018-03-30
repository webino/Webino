<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Config\Cache;

use Webino\Config\AbstractConfig;

/**
 * Class BlackHole
 */
class BlackHole extends AbstractConfig
{
    /**
     * Configure black hole cache
     */
    public function __construct()
    {
        $this->mergeArray([
            'adapter' => ['name' => 'blackhole', 'options' => null],
            'plugins' => null,
        ]);
    }
}
