<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino;

/**
 * Interface EventResultsInterface
 * @package webino-event-emitter
 */
interface EventResultsInterface
{
    /**
     * Add new response on top of others
     *
     * @param mixed $response Event response value
     * @return void
     */
    function add($response): void;
}
