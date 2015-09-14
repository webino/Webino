<?php

namespace WebinoViewLib\Component;

use WebinoDomLib\Event\RenderEvent;

/**
 * Interface OnRenderComponentInterface
 */
interface OnRenderComponentInterface
{
    /**
     * @param RenderEvent $event
     */
    public function onRender(RenderEvent $event);
}
