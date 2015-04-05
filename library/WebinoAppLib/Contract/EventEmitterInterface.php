<?php

namespace WebinoAppLib\Contract;

/**
 * Interface EventEmitterInterface
 */
interface EventEmitterInterface
{
    /**
     * Attach a listener to an event
     *
     * @param string $event
     * @param string|callable|int $callback callable|int $callback If string $event provided, expects PHP callback;
     *                                          for a ListenerAggregateInterface $event, this will be the priority
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
     * @return self
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
