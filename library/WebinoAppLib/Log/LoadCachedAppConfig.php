<?php

namespace WebinoAppLib\Log;

use WebinoLogLib\Message\AbstractInfoMessage;
use Zend\Stdlib\Parameters;

/**
 * Class LoadCachedAppConfig
 */
class LoadCachedAppConfig extends AbstractInfoMessage
{
    /**
     * {@inheritdoc}
     */
    public function getMessage(Parameters $args)
    {
        return 'Loading cached application configuration';
    }
}
