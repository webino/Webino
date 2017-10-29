<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoLogLib\Message;

use WebinoLogLib\SeverityInterface;
use Zend\Stdlib\Parameters;

/**
 * Interface MessageInterface
 */
interface MessageInterface extends SeverityInterface
{
    /**
     * Message severity
     *
     * @return int
     */
    public function getLevel();

    /**
     * Return the log message
     *
     * @param Parameters $args Message arguments
     * @return mixed
     */
    public function getMessage(Parameters $args);
}
