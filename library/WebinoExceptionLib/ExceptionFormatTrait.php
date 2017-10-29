<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoExceptionLib;

/**
 * Trait ExceptionFormatTrait
 *
 * Used to format the exception message.
 */
trait ExceptionFormatTrait
{
    /**
     * Format the exception message via sprintf()
     *
     * @param array $args
     * @return $this
     */
    public function format(...$args)
    {
        if (empty($this->message)) {
            return $this;
        }

        $params = [$this->message];
        foreach ($args as $arg) {
            if (is_string($arg)) {
                $params[] = '`' . $arg . '`';

            } elseif (is_object($arg)) {
                $params[] = '`' . get_class($arg) . '`';
            } else {
                $params[] = print_r($arg, true);
            }
        }
        $this->message = call_user_func('sprintf', ...$params);
        return $this;
    }
}
