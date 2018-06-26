<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Exception;

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
     * @param array $params Message parameters
     * @return $this
     */
    public function format(...$params)
    {
        if (empty($this->message)) {
            return $this;
        }

        $args = [$this->message];
        foreach ($params as $param) {
            if (is_string($param)) {
                $args[] = '`' . $param . '`';

            } elseif (is_object($param)) {
                $args[] = '`' . get_class($param) . '`';
            } else {
                $args[] = print_r($param, true);
            }
        }
        $this->message = call_user_func('sprintf', ...$args);
        return $this;
    }
}
