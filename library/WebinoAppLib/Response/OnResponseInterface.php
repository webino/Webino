<?php

namespace WebinoAppLib\Response;

use WebinoAppLib\Event\DispatchEvent;

/**
 * Interface OnResponseInterface
 */
interface OnResponseInterface
{
    /**
     * @param DispatchEvent $event
     */
    public function onResponse(DispatchEvent $event);
}
