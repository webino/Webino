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

use Webino\Base\Util\ToArrayInterface;

/**
 * Class EventResponses
 */
class EventResponses implements
    EventResponsesInterface,
    ToArrayInterface
{
    /**
     * @var array
     */
    protected $responses = [];

    /**
     * Create event responses from array values
     *
     * @param array $responses Event responses values array
     */
    public function __construct(array $responses = [])
    {
        $this->responses = $responses;
    }

    /**
     * Add new response on top of others
     *
     * @param mixed $response Event response value
     * @return void
     */
    public function add($response) : void
    {
        array_unshift($this->responses, $response);
    }

    /**
     * Return responses as array
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->responses;
    }
}
