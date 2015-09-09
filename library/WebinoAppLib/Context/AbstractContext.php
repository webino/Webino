<?php

namespace WebinoAppLib\Context;

use WebinoConfigLib\Feature\FeatureInterface;

/**
 * Class AbstractContext
 */
abstract class AbstractContext implements
    ContextInterface,
    FeatureInterface
{
    /**
     * Config key
     */
    const CONTEXT = 'context';

    /**
     * @return array
     */
    public function toArray()
    {
        return [self::CONTEXT => [static::class => ['class' => static::class]]];
    }
}
