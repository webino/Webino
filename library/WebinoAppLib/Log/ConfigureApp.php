<?php

namespace WebinoAppLib\Log;

use WebinoLogLib\Message\AbstractInfoMessage;
use Zend\Stdlib\Parameters;

/**
 * Class ConfigureApp
 */
class ConfigureApp extends AbstractInfoMessage
{
    /**
     * {@inheritdoc}
     */
    public function getMessage(Parameters $args)
    {
        return 'Configuring application';
    }
}
