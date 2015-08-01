<?php

namespace WebinoAppLib\Log;

/**
 * Class ConfigureApp
 */
class ConfigureApp extends AbstractInfoMessage
{
    /**
     * {@inheritdoc}
     */
    public function getMessage(...$args)
    {
        return 'Configuring application';
    }
}
