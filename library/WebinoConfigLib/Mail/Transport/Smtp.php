<?php

namespace WebinoConfigLib\Mail\Transport;

use WebinoBaseLib\Mail\Filename;

/**
 * Class Smtp
 */
class Smtp extends AbstractTransport
{
    /**
     * Create SMTP mail transport
     */
    public function __construct($host, $username, $password)
    {
        $this->setType('smtp');
        $this->setOptions([
            'host' => $host,
            'connection_class' => 'login',
            'connection_config' => [
                'username' => $username,
                'password' => $password,
            ],
        ]);
    }

    /**
     * @param int $port
     * @return $this
     */
    public function setSsl($port = 465)
    {
        $this->setOptions([
            'port' => $port,
            'connection_config' => ['ssl' => 'ssl'],
        ]);
        return $this;
    }

    /**
     * @param int $port
     * @return $this
     */
    public function setTls($port = 587)
    {
        $this->setOptions([
            'port' => $port,
            'connection_config' => ['ssl' => 'tls'],
        ]);
        return $this;
    }
}
