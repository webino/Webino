<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Contract;

/**
 * Interface EventEmitterInterface
 */
interface EventsInterface
{
    /**
     * Attach a listener to an event
     *
     * @param string|\Zend\EventManager\ListenerAggregateInterface $event
     * @param string|callable|int $callback If string $event provided, expects PHP callback;
     * @param int $priority Invocation priority
     * @return \Zend\Stdlib\CallbackHandler|mixed CallbackHandler if attaching callable
     *                          (to allow later unsubscribe); mixed if attaching aggregate
     */
    public function bind($event, $callback = null, $priority = 1);

    /**
     * Detach a listener from events
     *
     * @param string $event
     * @param null $callback
     * @param int $priority Invocation priority
     * @return $this
     */
    public function unbind($event, $callback = null, $priority = null);

    /**
     * Emit an event
     *
     * @param string|\Zend\EventManager\EventInterface $event
     * @param array $args Array of arguments; typically, should be associative
     * @param null $callback Trigger listeners until return value of this callback evaluate to true
     * @return \Zend\EventManager\ResponseCollection All listener return values
     * @throws \Zend\EventManager\Exception\InvalidCallbackException
     */
    public function emit($event, $args = [], $callback = null);
}
