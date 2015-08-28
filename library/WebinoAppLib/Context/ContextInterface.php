<?php

namespace WebinoAppLib\Context;

use WebinoAppLib\Event\AppEvent;

/**
 * Interface ContextInterface
 */
interface ContextInterface
{
    /**
     * @param AppEvent $event
     * @return bool
     */
    public function contextMatch(AppEvent $event);
}
