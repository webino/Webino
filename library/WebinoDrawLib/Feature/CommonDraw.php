<?php

namespace WebinoDrawLib\Feature;

use WebinoConfigLib\Config;
use WebinoConfigLib\Feature\FeatureInterface;

/**
 * Class CommonDraw
 */
class CommonDraw extends Config implements
    FeatureInterface
{
    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $spec = [];
        foreach ($config as $feature) {
            $spec[$feature->getName()] = $feature->toArray();
        }
        parent::__construct([['draw' => ['common' => $spec]]]);
    }
}
