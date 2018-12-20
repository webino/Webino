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
 * Class EventResults
 * @package webino-event-emitter
 */
class EventResults implements
    EventResultsInterface
{
    /**
     * @var array
     */
    protected $results = [];

    /**
     * Create event Results from array values
     *
     * @param array $results Event Results values array
     */
    function __construct(array $results = [])
    {
        $this->results = $results;
    }

    /**
     * Add new response on top of others
     *
     * @param mixed $response Event response value
     * @return void
     */
    function add($response): void
    {
        array_unshift($this->results, $response);
    }

    /**
     * Return Results as array
     *
     * @return array
     */
    function toArray(): array
    {
        return $this->results;
    }

    /**
     * @return string
     */
    function __toString(): string
    {
        return join(null, $this->results);
    }
}
