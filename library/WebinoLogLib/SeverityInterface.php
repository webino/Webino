<?php

namespace WebinoLogLib;

use Zend\Log\Logger as BaseLogger;

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
    const EMERGENCY = BaseLogger::EMERG;

    /**
     * Alert
     *
     * Immediate action is required.
     */
    const ALERT = BaseLogger::ALERT;

    /**
     * Critical
     *
     * Critical conditions.
     */
    const CRITICAL = BaseLogger::CRIT;

    /**
     * Error
     *
     * Errors that do not require immediate
     * attention but should be monitored.
     */
    const ERROR = BaseLogger::ERR;

    /**
     * Warning
     *
     * Unusual or undesirable occurrences that are not errors.
     */
    const WARNING = BaseLogger::WARN;

    /**
     * Notice
     *
     * Normal but significant events.
     */
    const NOTICE = BaseLogger::NOTICE;

    /**
     * Info
     *
     * Interesting events.
     */
    const INFO = BaseLogger::INFO;

    /**
     * Debug
     *
     * Detailed information for debugging purposes.
     */
    const DEBUG = BaseLogger::DEBUG;
}
