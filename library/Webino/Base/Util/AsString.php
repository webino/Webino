<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Base\Util;

/**
 * Class AsString
 */
class AsString
{
    use SingletonTrait;

    /**
     * Returns subject as string
     *
     * @param mixed $subject
     * @return string
     */
    public function __invoke($subject) : string
    {
        return is_array($subject) ? join(null, $subject) : (string) $subject;
    }

    /**
     * Returns item as string
     *
     * @param mixed $subject
     * @return string
     */
    public static function value($subject) : string
    {
        return static::getInstance()->__invoke($subject);
    }
}
