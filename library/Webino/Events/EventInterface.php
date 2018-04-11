<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Events;

/**
 * Interface EventInterface
 */
interface EventInterface extends \ArrayAccess
{
    /**
     * The beginning of the event
     */
    const BEGIN = 9000;

    /**
     * Before main event
     */
    const BEFORE = 5000;

    /**
     * After main event
     */
    const AFTER = -5000;

    /**
     * At the end of the event
     */
    const FINISH = -9000;

    /**
     * Event priority offset
     */
    const OFFSET = 10;

    /**
     * Get event name
     *
     * @return string Event name
     */
    public function getName() : string;

    /**
     * Set the event name
     *
     * @param string $name Event name
     * @return void
     */
    public function setName(string $name) : void;

    /**
     * Get target object from which event was emitted
     *
     * @return EventTargetInterface Event target object
     */
    public function getTarget() : EventTargetInterface;

    /**
     * Set the event target object
     *
     * @param EventTargetInterface $target Event target object
     * @return void
     */
    public function setTarget(EventTargetInterface $target) : void;

    /**
     * Get event value by name
     *
     * If the event value does not exist, the default value will be returned.
     *
     * @param string $name Value name
     * @param mixed $default Default value to return if event value does not exist
     * @return mixed Event value
     */
    public function getValue(string $name, $default = null);

    /**
     * Return event responses
     *
     * @return EventResponses Event responses
     */
    public function getResponses() : EventResponses;

    /**
     * Set event responses
     *
     * Overwrites responses.
     *
     * @param array $responses Responses array
     * @return void
     */
    public function setResponses(array $responses) : void;

    /**
     * Set event response value
     *
     * Add new response value on top of existing responses.
     *
     * @param mixed $response Event response value
     * @return void
     */
    public function setResponse($response) : void;

    /**
     * Indicate whether or not to stop propagating this event
     *
     * @param bool $stop Set true to stop propagation
     * @return void
     */
    public function stopPropagation(bool $stop = true) : void;

    /**
     * Has this event indicated event propagation should stop?
     *
     * @return bool True when propagation is stopped
     */
    public function isPropagationStopped() : bool;
}
