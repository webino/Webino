<?php

namespace WebinoAppLib\Service\Initializer;

use WebinoAppLib\Contract\RouterInterface;

/**
 * Interface RoutingAwareInterface
 */
interface RoutingAwareInterface
{
    /**
     * @return RouterInterface|null
     */
    public function getRouter();

    /**
     * @param RouterInterface $router
     */
    public function setRouter(RouterInterface $router);
}
