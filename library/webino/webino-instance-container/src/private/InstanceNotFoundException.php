<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino;

use Psr\Container\NotFoundExceptionInterface;

/**
 * Class InstanceNotFoundException
 * @package webino-instance-container
 */
final class InstanceNotFoundException extends InstanceContainerException implements NotFoundExceptionInterface
{

}
