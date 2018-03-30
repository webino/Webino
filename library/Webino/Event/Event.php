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
 * Class Event
 */
class Event implements EventInterface
{
    use EventTrait;

    /**
     * Create new event from string or other event object
     *
     * @param string|self|null $event Event name or object
     * @param EventTargetInterface|null $target Event target object
     * @param array|null $params Event parameters array
     */
    public function __construct($event = null, EventTargetInterface $target = null, array $params = [])
    {
        // event class as default event name
        $event or $event = get_class($this);

        // init event from string or object
        if (is_string($event)) {
            $this->setName($event);
        } elseif ($event instanceof EventInterface) {
            $this->setTarget($event->getTarget());
            $this->setParams($event->getParams());
        }

        // set event target and parameters if any
        $target and $this->setTarget($target);
        $params and $this->setParams($params);
    }
}
