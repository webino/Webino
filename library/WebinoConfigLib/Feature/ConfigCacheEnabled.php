<?php

namespace WebinoConfigLib\Feature;

/**
 * Class ConfigCacheEnabled
 */
class ConfigCacheEnabled extends AbstractFeature
{
    /**
     * Application configuration key
     */
    const KEY = 'configCacheEnabled';

    /**
     * @param bool $enabled
     */
    public function __construct($enabled = true)
    {
        $this->getData()->exchangeArray([$this::KEY => $enabled]);
    }
}
