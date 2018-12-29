<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino;

/**
 * Interface EventInterface
 * @package webino-event-emitter
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
    function getName(): string;

    /**
     * Set the event name
     *
     * @param string $name Event name
     * @return void
     */
    function setName(string $name): void;

    /**
     * Get target object from which event was emitted
     *
     * @return EventEmitterInterface Event target object
     */
    function getTarget(): EventEmitterInterface;

    /**
     * Set the event target object
     *
     * @param EventEmitterInterface|\object $target Event target object
     * @return void
     */
    function setTarget(EventEmitterInterface $target): void;

    /**
     * Get event value by name
     *
     * If the event value does not exist, the default value will be returned.
     *
     * @param string $name Value name
     * @param mixed $default Default value to return if event value does not exist
     * @return mixed Event value
     */
    function getValue(string $name, $default = null);

    /**
     * Set event values
     *
     * @param iterable $values
     */
    function setValues(iterable $values): void;

    /**
     * Return event results
     *
     * @return EventResults Event results
     */
    function getResults(): EventResults;

    /**
     * Set event results
     *
     * Overwrites results.
     *
     * @param EventResults|array $results Results array
     * @return void
     */
    function setResults($results): void;

    /**
     * Set event result value
     *
     * Add new result value on top of existing results.
     *
     * @param mixed $result Event result value
     * @return void
     */
    function setResult($result): void;

    /**
     * Indicate whether or not to stop propagating this event
     *
     * @param bool $stop Set true to stop propagation
     * @return void
     */
    function stopPropagation(bool $stop = true): void;

    /**
     * Has this event indicated event propagation should stop?
     *
     * @return bool True when propagation is stopped
     */
    function isPropagationStopped(): bool;
}
