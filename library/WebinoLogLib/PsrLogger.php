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

use Psr\Log\AbstractLogger;
use WebinoLogLib\Exception\InvalidArgumentException;
use Zend\Log\Logger as LoggerEngine;

/**
 * Class PsrLogger
 */
final class PsrLogger extends AbstractLogger implements
    SeverityInterface
{
    /**
     * @var LoggerEngine
     */
    private $engine;

    /**
     * @param LoggerEngine $engine
     */
    public function __construct(LoggerEngine $engine)
    {
        $this->engine = $engine;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return void
     * @throws InvalidArgumentException Unknown error level
     */
    public function log($level, $message, array $context = [])
    {
        $this->engine->log(
            $this->normalizeLevel($level),
            $this->normalizeMessage($message),
            $context
        );
    }

    /**
     * @param int $level
     * @return mixed
     * @throws InvalidArgumentException Unknown error level
     */
    private function normalizeLevel($level)
    {
        if (is_numeric($level)) {
            return $level;
        }

        $const = self::class . '::' . strtoupper($level);
        if (defined($const)) {
            return constant($const);
        }

        throw (new InvalidArgumentException('Unknown error level %s'))
            ->format($level);
    }

    /**
     * @param $message
     * @return mixed
     */
    private function normalizeMessage($message)
    {
        if (is_object($message) && !method_exists($message, '__toString')) {
            return print_r($message, true);
        }
        return (string) $message;
    }
}
