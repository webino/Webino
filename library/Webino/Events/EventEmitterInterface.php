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
 * Interface EventEmitterInterface
 */
interface EventEmitterInterface
{
    /**
     * Set event handler
     *
     * @param string|EventInterface $event Event name or object
     * @param callable $handler Event handler
     * @param int $priority Event handler order priority
     * @return void
     */
    public function on($event, callable $handler, int $priority = 1) : void;

    /**
     * Remove event handler
     *
     * @param callable|null $handler Event handler
     * @param string|EventInterface $event Event name or object
     * @return void
     */
    public function off(callable $handler = null, $event) : void;

    /**
     * Emit an event
     *
     * @param string|EventInterface $event Event name or object
     * @param array $params Event parameters
     * @param callable|null $until Invoke handlers until callback return value evaluate to true
     * @return EventInterface Event object
     */
    public function emit($event, array $params = [], callable $until = null) : EventInterface;
}
