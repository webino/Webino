<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Event\Exception;

use Webino\Exception\ExceptionFormatTrait;
use Zend\EventManager\Exception\RuntimeException as BaseRuntimeException;

/**
 * Class RuntimeException
 */
class RuntimeException extends BaseRuntimeException implements ExceptionInterface
{
    use ExceptionFormatTrait;
}
