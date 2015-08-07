<?php

namespace WebinoDomLib\Factory;

// TODO exception
//use WebinoDomLib\Exception\OutOfBoundsException;
use WebinoDomLib\Locator\Strategy\CssStrategy;
use WebinoDomLib\Locator\Strategy\XpathStrategy;

/**
 * Class LocatorStrategyFactory
 */
final class LocatorStrategyFactory
{
    /**
     * Default strategy key
     */
    const DEFAULT_STRATEGY = 'css';

    /**
     * Available strategies
     *
     * @var array
     */
    protected static $strategyList = [
        'css'   => CssStrategy::class,
        'xpath' => XpathStrategy::class,
    ];

    /**
     * @param string $type Strategy type
     * @return TransformatorInterface
     * @throws OutOfBoundsException
     */
    public function create($type)
    {
        $strategy = empty($type) ? self::DEFAULT_STRATEGY : $type;
        if (empty(self::$strategyList[$strategy])) {
            // TODO exception
//            throw new OutOfBoundsException('Dont\'t know strategy type ' . $strategy);
        }

        return new self::$strategyList[$strategy];
    }
}
