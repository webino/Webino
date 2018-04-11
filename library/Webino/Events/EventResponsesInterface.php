<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Events;

/**
 * Interface EventResponsesInterface
 */
interface EventResponsesInterface
{
    /**
     * Add new response on top of others
     *
     * @param mixed $response Event response value
     * @return void
     */
    public function add($response) : void;
}
