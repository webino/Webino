<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Contract;

use WebinoLogLib\LoggerInterface as BaseLoggerInterface;

/**
 * Interface LoggerInterface
 */
interface LoggerInterface extends BaseLoggerInterface
{
    /**
     * @param string $name
     * @return \WebinoLogLib\LoggerInterface|object
     */
    public function getLogger($name = null);

    /**
     * Write a message to a log
     *
     * @param string|\WebinoLogLib\Message\MessageInterface|null $level Message severity or a MessageInterface
     *  class name or an object.
     * @param mixed ...$args Message parameters, if $level is a string the first argument is a message text.
     * @return \Psr\Log\LoggerInterface
     */
    public function log($level = null, ...$args);
}
