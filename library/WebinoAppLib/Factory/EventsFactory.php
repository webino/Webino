<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Factory;

use WebinoAppLib\Event\AppEvent;
use WebinoEventLib\EventManager;

/**
 * Class EventsFactory
 */
final class EventsFactory extends AbstractFactory
{
    /**
     * {@inheritdoc}
     */
    protected function create()
    {
        // TODO use setEventPrototype instead of setEventClass, cause deprecated by Zend
        return (new EventManager)->setEventClass(AppEvent::class);
    }
}
