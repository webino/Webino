<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Event;

/**
 * Class EventEmitter
 */
class EventEmitter implements EventEmitterInterface
{
    use EventEmitterTrait;

    /**
     * Event prototype default class
     */
    const EVENT_CLASS = Event::class;

    /**
     * Create new event emitter object
     *
     * @param EventTargetInterface|null $target Event target object
     * @param EventInterface|null $eventPrototype Event prototype object
     */
    public function __construct(EventTargetInterface $target = null, EventInterface $eventPrototype = null)
    {
        $this->eventPrototype = $eventPrototype ?: $this->createEvent();
        $target and $this->eventPrototype->setTarget($target);
    }

    /**
     * Return new event object
     *
     * @return EventInterface
     */
    protected function createEvent() : EventInterface
    {
        $class = $this::EVENT_CLASS;
        return new $class;
    }
}
