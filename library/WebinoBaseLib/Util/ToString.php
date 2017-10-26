<?php

namespace WebinoBaseLib\Util;

/**
 * Class ToString
 */
class ToString
{
    use SingletonTrait;

    /**
     * Returns item as string
     *
     * @param mixed $item
     * @return string
     */
    public function __invoke($item)
    {
        return is_array($item) ? join(null, $item) : (string) $item;
    }

    /**
     * Returns item as string
     *
     * @param mixed $item
     * @return string
     */
    public static function value($item)
    {
        return static::getInstance()->__invoke($item);
    }
}
