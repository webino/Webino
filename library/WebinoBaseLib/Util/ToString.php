<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
