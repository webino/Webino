<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoEventLib\Exception;

use WebinoExceptionLib\ExceptionFormatTrait;
use Zend\EventManager\Exception\InvalidArgumentException as BaseInvalidArgumentException;

/**
 * Class InvalidArgumentException
 */
class InvalidArgumentException extends BaseInvalidArgumentException implements ExceptionInterface
{
    use ExceptionFormatTrait;
}
