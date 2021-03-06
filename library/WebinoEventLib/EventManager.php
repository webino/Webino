<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoEventLib;

use Zend\EventManager\EventInterface as BaseEventInterface;
use Zend\EventManager\EventManager as BaseEventManager;
use Zend\EventManager\ResponseCollection;

/**
 * Class EventManager
 */
class EventManager extends BaseEventManager
{
    /**
     * {@inheritdoc}
     */
    protected $eventClass = Event::class;

    /**
     * Trigger listeners
     *
     * Added argument unpacking support, removed shared events support.
     *
     * @param string $eventName Event name
     * @param BaseEventInterface $event Event object
     * @param null|callable $callback
     * @return ResponseCollection
     */
    protected function triggerListeners($eventName, BaseEventInterface $event, $callback = null)
    {
        $responses = new ResponseCollection;
        $listeners = $this->getListeners($eventName);

        // (removed shared listeners support)

        // (prepare event params for unpacking)
        $params = array_values((array) $event->getParams());

        foreach ($listeners as $key => $listener) {
            /** @var \Zend\Stdlib\CallbackHandler $listener */
            $listenerCallback = $listener->getCallback();

            // (added argument unpacking)
            $responses->push(call_user_func($listenerCallback, $event, ...$params));

            // If the event was asked to stop propagating, do so
            if ($event->propagationIsStopped()) {
                $responses->setStopped(true);
                break;
            }

            // If the result causes our validation callback to return true,
            // stop propagation
            if ($callback && call_user_func($callback, $responses->last())) {
                $responses->setStopped(true);
                break;
            }
        }

        return $responses;
    }
}
