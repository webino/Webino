<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoConfigLib\Mail\Transport;

/**
 * Class Smtp
 */
class Smtp extends AbstractTransport
{
    /**
     * @param string $host
     * @param string $username
     * @param string $password
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
