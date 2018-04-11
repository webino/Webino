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
 * Interface EventHandlerInterface
 */
interface EventHandlerInterface
{
    /**
     * Attach event emitter to handler
     *
     * @param EventEmitterInterface $emitter Event emitter
     * @return void
     */
    public function attachEventEmitter(EventEmitterInterface $emitter) : void;

    /**
     * Detach event emitter from handler
     *
     * @param EventEmitterInterface $emitter Event emitter
     * @return void
     */
    public function detachEventEmitter(EventEmitterInterface $emitter) : void;
}
