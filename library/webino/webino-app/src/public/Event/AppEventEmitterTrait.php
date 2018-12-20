<?php

namespace Webino;

/**
 * Trait AppEventEmitterTrait
 * @package webino-app
 */
trait AppEventEmitterTrait
{
    use EventEmitterTrait {
        EventEmitterTrait::on as internalOn;
    }

    /**
     * {@inheritdoc}
     */
    function on($event, $callback = null, int $priority = 1)
    {
        $this->internalOn(
            $callback ? $event : $this->get($event),
            is_string($callback) ? $this->get($callback) : $callback,
            $priority
        );
    }
}
