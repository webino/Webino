<?php

namespace WebinoAppLib\Service\Initializer;

use WebinoAppLib\Contract\RouterInterface;

/**
 * Class RoutingAwareTrait
 */
trait RoutingAwareTrait
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @return RouterInterface|null
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * @param RouterInterface $router
     */
    public function setRouter(RouterInterface $router)
    {
        $this->router = $router;
    }
}
