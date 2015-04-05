<?php

namespace WebinoAppLib\Log;

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
    public function getMessage(...$args)
    {
        return 'Event: ' . (($args[0] instanceof Event) ? $args[0]->getName() : (string) $args[0]);
    }
}
