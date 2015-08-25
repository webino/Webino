<?php

namespace WebinoAppLib\Response;

use WebinoAppLib\Event\SendResponseEvent;

/**
 * Interface OnResponseInterface
 */
interface OnResponseInterface
{
    /**
     * @param SendResponseEvent $event
     */
    public function onResponse(SendResponseEvent $event);
}
