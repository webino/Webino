<?php

namespace WebinoViewLib\Component;

use WebinoAppLib\Service\Initializer\RoutingAwareInterface;
use WebinoDomLib\Event\RenderEvent;

/**
 * Interface ComponentStateInterface
 */
interface ComponentStateInterface extends
    OnRenderComponentInterface,
    RoutingAwareInterface
{

}
