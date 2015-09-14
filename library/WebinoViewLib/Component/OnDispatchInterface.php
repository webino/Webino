<?php

namespace WebinoViewLib\Component;

use WebinoAppLib\Event\DispatchEvent;

/**
 * Interface OnDispatchInterface
 */
interface OnDispatchInterface
{
    /**
     * @param DispatchEvent $event
     */
    public function onDispatch(DispatchEvent $event);
}
