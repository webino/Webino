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
    const KEY = 'context';

    /**
     * @return string
     */
    abstract protected function getKey();

    /**
     * @return array
     */
    public function toArray()
    {
        return [self::KEY => [$this->getKey() => ['class' => static::class]]];
    }
}
