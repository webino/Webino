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
 * Interface EventInterface
 */
interface EventInterface
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
     * Get parameters passed to the event
     *
     * @return array Parameters array
     */
    public function getParams() : array;

    /**
     * Set event parameters
     *
     * Overwrites parameters
     *
     * @param array $params Parameters array
     * @return void
     */
    public function setParams(array $params) : void;

    /**
     * Get a single parameter by name
     *
     * If the parameter does not exist, the $default value will be returned.
     *
     * @param string $name Parameter name
     * @param mixed $default Default value to return if parameter does not exist
     * @return mixed Parameter value
     */
    public function getParam(string $name, $default = null);

    /**
     * Set an individual parameter to a value
     *
     * @param string $name Parameter name
     * @param mixed $value Parameter value
     * @return void
     */
    public function setParam(string $name, $value) : void;

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
