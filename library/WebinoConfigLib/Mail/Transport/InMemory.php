<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoConfigLib\Mail\Transport;

/**
 * Class InMemory
 */
class InMemory extends AbstractTransport
{
    /**
     * Create a in memory mail transport
     */
    public function __construct()
    {
        $this->setType('inmemory');
    }
}
