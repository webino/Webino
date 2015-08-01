<?php

namespace WebinoAppLib\Log;

/**
 * Class LoadCachedAppConfig
 */
class LoadCachedAppConfig extends AbstractInfoMessage
{
    /**
     * {@inheritdoc}
     */
    public function getMessage(...$args)
    {
        return 'Loading cached application configuration';
    }
}
