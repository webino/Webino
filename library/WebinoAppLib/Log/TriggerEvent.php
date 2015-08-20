<?php

namespace WebinoAppLib\Log;

use WebinoLogLib\Message\AbstractInfoMessage;
use Zend\EventManager\Event;

/**
 * Class TriggerEvent
 */
class TriggerEvent extends AbstractInfoMessage
{
    const LEVEL = self::INFO;

    /**
     * {@inheritdoc}
     */
    public function getMessage(array $args)
    {
        return sprintf('Event: `%s`', (($args[0] instanceof Event) ? $args[0]->getName() : (string) $args[0]));
    }
}
