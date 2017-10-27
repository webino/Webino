<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoConfigLib\Feature;

use WebinoConfigLib\Mail\Transport;

/**
 * Class AbstractMailer
 */
abstract class AbstractMailer extends AbstractFeature
{
    /**
     * Config key
     */
    const KEY = 'mail';
    
    /**
     * @var Transport\AbstractTransport
     */
    protected $transport;

    /**
     * @var string
     */
    protected $transportKey;

    /**
     * @return string
     */
    protected function getTransportKey()
    {
        if (null === $this->transportKey) {
            $this->setTransportKey(get_class($this));
        }
        return $this->transportKey;
    }

    /**
     * @param string $key
     * @return $this
     */
    protected function setTransportKey($key)
    {
        $this->transportKey = (string) $key;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $this->mergeArray([
            $this::KEY => [
                // TODO constant transports
                'transports' => [
                    $this->getTransportKey() => $this->transport->toArray(),
                ],
            ],
        ]);

        return parent::toArray();
    }
}
