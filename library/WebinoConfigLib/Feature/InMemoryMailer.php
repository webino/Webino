<?php

namespace WebinoConfigLib\Feature;

use WebinoConfigLib\Mail\Transport;

/**
 * Class InMemoryMailer
 */
class InMemoryMailer extends AbstractMailer
{
    /**
     * In memory mailer
     */
    public function __construct()
    {
        $this->transport = new Transport\InMemory;
    }
}
