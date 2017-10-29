<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoConfigLib\Feature;

use WebinoConfigLib\Cache\BlackHole;

/**
 * Class NullCache
 */
class NullCache extends AbstractCache
{
    /**
     * Configure the null cache
     */
    public function __construct()
    {
        parent::__construct([[$this::KEY => (new BlackHole)->toArray()]]);
    }
}
