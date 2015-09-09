<?php

namespace WebinoConfigLib\Feature;

use WebinoConfigLib\Mail\Transport;

/**
 * Class SmtpMailer
 */
class SmtpMailer extends AbstractMailer
{
    /**
     * @param string $host
     * @param string $username
     * @param string $password
     */
    public function __construct($host, $username, $password)
    {
        $this->transport = new Transport\Smtp($host, $username, $password);
    }

    /**
     * @param int $port
     * @return $this
     */
    public function setSsl($port = 465)
    {
        $this->transport->setSsl($port);
        return $this;
    }

    /**
     * @param int $port
     * @return $this
     */
    public function setTls($port = 587)
    {
        $this->transport->setTls($port);
        return $this;
    }
}
