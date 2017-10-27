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

use WebinoConfigLib\Feature\MemoryCache as Engine;

/**
 * Class MemoryCache
 */
class MemoryCache extends AbstractCache
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
