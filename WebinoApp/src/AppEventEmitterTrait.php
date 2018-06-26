<?php

namespace Webino;

/**
 * Trait AppEventEmitterTrait
 */
trait AppEventEmitterTrait
{
    use EventEmitterTrait {
        EventEmitterTrait::on as internalOn;
    }

    /**
     * {@inheritdoc}
     */
    public function on($event, $callback = null, int $priority = 1)
    {
        $this->internalOn(
            $callback ? $event : $this->get($event),
            is_string($callback) ? $this->get($callback) : $callback,
            $priority
        );
    }
}
