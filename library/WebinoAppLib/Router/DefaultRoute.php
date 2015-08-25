<?php

namespace WebinoAppLib\Router;

use WebinoConfigLib\Feature\FeatureInterface;
use WebinoConfigLib\Feature\Route;

/**
 * Class DefaultRoute
 */
class DefaultRoute implements
    FeatureInterface,
    RouteInterface
{
    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return (new Route(self::class))
            ->setLiteral('/')
            ->toArray();
    }
}
