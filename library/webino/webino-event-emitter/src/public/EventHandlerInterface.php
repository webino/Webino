<?php

namespace Webino;

/**
 * Interface EventHandlerInterface
 * @package webino-event-emitter
 */
interface EventHandlerInterface
{
    /**
     * Attach event emitter to handler
     *
     * @param EventEmitterInterface $emitter Event emitter
     * @return void
     */
    function attachEventEmitter(EventEmitterInterface $emitter): void;

    /**
     * Detach event emitter from handler
     *
     * @param EventEmitterInterface $emitter Event emitter
     * @return void
     */
    function detachEventEmitter(EventEmitterInterface $emitter): void;
}
