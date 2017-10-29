<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Log;

use WebinoLogLib\Message\AbstractInfoMessage;
use Zend\EventManager\Event;
use Zend\Stdlib\Parameters;

/**
 * Class TriggerEvent
 */
class TriggerEvent extends AbstractInfoMessage
{
    const LEVEL = self::INFO;

    /**
     * {@inheritdoc}
     */
    public function getMessage(Parameters $args)
    {
        $args[0] = ($args[0] instanceof Event) ? $args[0]->getName() : (string) $args[0];
        return 'Event {0}';
    }
}
