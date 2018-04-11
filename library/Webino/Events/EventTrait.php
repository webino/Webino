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
 * Trait EventTrait
 */
trait EventTrait
{
    /**
     * @var string Event name
     */
    protected $name;

    /**
     * @var EventTargetInterface The event target
     */
    protected $target;

    /**
     * @var array The event parameters
     */
    protected $params = [];

    /**
     * @var EventResponses
     */
    protected $responses;

    /**
     * @var bool Whether or not to stop propagation
     */
    protected $stopPropagation = false;

    /**
     * Get event name
     *
     * @return string Event name
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Set the event name
     *
     * @param string $name Event name
     * @return void
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    /**
     * Get target object from which event was emitted
     *
     * @return EventTargetInterface Event target object
     */
    public function getTarget() : EventTargetInterface
    {
        return $this->target;
    }

    /**
     * Set the event target object
     *
     * @param EventTargetInterface $target Event target object
     * @return void
     */
    public function setTarget(EventTargetInterface $target) : void
    {
        $this->target = $target;
    }

    /**
     * Get event value by name
     *
     * If the event value does not exist, the default value will be returned.
     *
     * @param string $name Value name
     * @param mixed $default Default value to return if event value does not exist
     * @return mixed Event value
     */
    public function getValue(string $name, $default = null)
    {
        return isset($this[$name]) ? $this[$name] : $default;
    }

    /**
     * Set event response value
     *
     * Add new response value on top of existing responses.
     *
     * @param mixed $response Event response value
     * @return void
     */
    public function setResponse($response) : void
    {
        $this->getResponses()->add($response);
    }

    /**
     * Return event responses
     *
     * @return EventResponses Event responses
     */
    public function getResponses() : EventResponses
    {
        return $this->responses ?: $this->responses = new EventResponses;
    }

    /**
     * Set event responses
     *
     * Overwrites responses.
     *
     * @param array $responses Responses array
     * @return void
     */
    public function setResponses(array $responses) : void
    {
        $this->responses = new EventResponses($responses);
    }

    /**
     * Indicate whether or not to stop propagating this event
     *
     * @param bool $stop Set true to stop propagation
     * @return void
     */
    public function stopPropagation(bool $stop = true) : void
    {
        $this->stopPropagation = $stop;
    }

    /**
     * Has this event indicated event propagation should stop?
     *
     * @return bool True when propagation is stopped
     */
    public function isPropagationStopped() : bool
    {
        return $this->stopPropagation;
    }
}
