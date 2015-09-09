<?php

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
                // TODO constant
                'transports' => [
                    $this->getTransportKey() => $this->transport->toArray(),
                ],
            ],
        ]);

        return parent::toArray();
    }
}
