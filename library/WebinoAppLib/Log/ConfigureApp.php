<?php

namespace WebinoAppLib\Log;

use WebinoLogLib\Message\AbstractInfoMessage;

/**
 * Class ConfigureApp
 */
class ConfigureApp extends AbstractInfoMessage
{
    /**
     * {@inheritdoc}
     */
    public function getMessage(array $args)
    {
        return 'Configuring application';
    }
}
