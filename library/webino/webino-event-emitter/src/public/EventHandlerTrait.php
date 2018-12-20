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
 * Class EventHandlerTrait
 * @package webino-event-emitter
 */
trait EventHandlerTrait
{
    /**
     * @var EventEmitterInterface
     */
    private $emitter;

    /**
     * @var callable[]
     */
    private $handlers = [];

    /**
     * Initialize events
     */
    abstract protected function initEvents(): void;

    /**
     * Handle an event
     *
     * @param string|EventInterface $event Event name or object
     * @param string|callable $callback Event handler
     * @param int $priority
     * @return void
     */
    protected function on($event, $callback, $priority = 1): void
    {
        $handler = is_string($callback) ? [$this, $callback] : $callback;
        $this->emitter->on($event, $handler, $priority);
        $this->handlers[] = $handler;
    }

    /**
     * Attach event emitter to handler
     *
     * @param EventEmitterInterface $emitter Event emitter
     * @return void
     */
    function attachEventEmitter(EventEmitterInterface $emitter): void
    {
        $this->emitter = $emitter;
        $this->initEvents();
    }

    /**
     * Detach event emitter from handler
     *
     * @param EventEmitterInterface $emitter Event emitter
     * @return void
     */
    function detachEventEmitter(EventEmitterInterface $emitter): void
    {
        foreach ($this->handlers as $index => $handler) {
            $emitter->off($handler);
            unset($this->handlers[$index]);
        }
    }
}
