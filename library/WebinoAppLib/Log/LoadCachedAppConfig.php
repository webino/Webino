<?php

namespace WebinoAppLib\Log;

use WebinoLogLib\Message\AbstractInfoMessage;

/**
 * Class LoadCachedAppConfig
 */
class LoadCachedAppConfig extends AbstractInfoMessage
{
    /**
     * {@inheritdoc}
     */
    public function getMessage(array $args)
    {
        return 'Loading cached application configuration';
    }
}
