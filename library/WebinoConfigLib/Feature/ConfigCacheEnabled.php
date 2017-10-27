<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoConfigLib\Feature;

/**
 * Class ConfigCacheEnabled
 */
class ConfigCacheEnabled extends AbstractFeature
{
    /**
     * Application configuration key
     */
    const KEY = 'configCacheEnabled';

    /**
     * @param bool $enabled
     */
    public function __construct($enabled = true)
    {
        parent::__construct([[$this::KEY => $enabled]]);
    }
}
