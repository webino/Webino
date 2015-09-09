<?php

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
