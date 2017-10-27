<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoLogLib;

use Zend\Log\Logger as LoggerEngine;

/**
 * Interface SeverityInterface
 */
interface SeverityInterface
{
    /**
     * Emergency
     *
     * The system is unusable.
     */
    const EMERGENCY = LoggerEngine::EMERG;

    /**
     * Alert
     *
     * Immediate action is required.
     */
    const ALERT = LoggerEngine::ALERT;

    /**
     * Critical
     *
     * Critical conditions.
     */
    const CRITICAL = LoggerEngine::CRIT;

    /**
     * Error
     *
     * Errors that do not require immediate
     * attention but should be monitored.
     */
    const ERROR = LoggerEngine::ERR;

    /**
     * Warning
     *
     * Unusual or undesirable occurrences that are not errors.
     */
    const WARNING = LoggerEngine::WARN;

    /**
     * Notice
     *
     * Normal but significant events.
     */
    const NOTICE = LoggerEngine::NOTICE;

    /**
     * Info
     *
     * Interesting events.
     */
    const INFO = LoggerEngine::INFO;

    /**
     * Debug
     *
     * Detailed information for debugging purposes.
     */
    const DEBUG = LoggerEngine::DEBUG;
}
