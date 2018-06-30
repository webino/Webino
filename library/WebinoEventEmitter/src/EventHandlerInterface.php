<?php

namespace Webino;

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
    public function attachEventEmitter(EventEmitterInterface $emitter): void;

    /**
     * Detach event emitter from handler
     *
     * @param EventEmitterInterface $emitter Event emitter
     * @return void
     */
    public function detachEventEmitter(EventEmitterInterface $emitter): void;
}
