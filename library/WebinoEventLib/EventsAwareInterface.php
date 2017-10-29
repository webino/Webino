<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoEventLib;

use Zend\EventManager\EventManagerInterface;

/**
 * Interface EventsAwareInterface
 */
interface EventsAwareInterface
{
    /**
     * Inject an EventManager instance
     *
     * @param EventManagerInterface $eventManager
     * @return void
     */
    public function setEvents(EventManagerInterface $eventManager);
}
