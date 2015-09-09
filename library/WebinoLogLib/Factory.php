<?php

namespace WebinoLogLib;

use WebinoLogLib\Exception;
use Zend\Log\Exception\InvalidArgumentException;
use Zend\Log\Logger as LoggerEngine;

/**
 * Class Factory
 */
final class Factory
{
    /**
     * @var LoggerEngine
     */
    public $loggerEngine;

    /**
     * Create a logger
     *
     * Set options for a logger. Accepted options are:
     * - writers: array of writers to add to this logger
     * - exceptionhandler: if true register this logger as exceptionhandler
     * - errorhandler: if true register this logger as errorhandler
     *
     * @param array|\Traversable $options
     * @return Logger
     * @throws Exception\InvalidArgumentException
     */
    public function create($options = null)
    {
        try {
            $this->loggerEngine = new LoggerEngine($options);
        } catch (InvalidArgumentException $exc) {
            throw new Exception\InvalidArgumentException('Unable to create a logger', null, $exc);
        }

        return new Logger(new PsrLogger($this->loggerEngine));
    }
}
