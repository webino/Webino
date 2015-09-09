<?php

namespace WebinoAppLib\Context;

use WebinoAppLib\Event\AppEvent;

/**
 * Class HttpContext
 */
class HttpContext extends AbstractContext
{
    /**
     * Returns true for HTTP environment
     *
     * @param AppEvent $event
     * @return bool
     */
    public function contextMatch(AppEvent $event)
    {
        return $event->getApp()->isHttp();
    }
}
