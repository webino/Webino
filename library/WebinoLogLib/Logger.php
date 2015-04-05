<?php

namespace WebinoLogLib;

use Psr\Log\AbstractLogger;
use WebinoLogLib\Exception\InvalidArgumentException;
use Zend\Log\Logger as LoggerEngine;

/**
 * Class Logger
 */
final class Logger extends AbstractLogger implements
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
     * @return null
     * @throws InvalidArgumentException Unknown error level
     */
    public function log($level, $message, array $context = [])
    {
        $this->engine->log(
            $this->normalizeLevel($level),
            $this->interpolate($this->normalizeMessage($message), $context),
            $context
        );
        return null;
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

    /**
     * Interpolates context values into the message placeholders.
     *
     * @param $message
     * @param array $context
     * @return string
     */
    private function interpolate($message, array $context = [])
    {
        $replace = [];
        foreach ($context as $key => $val) {
            $replace['{' . $key . '}'] = $val;
        }
        return strtr($message, $replace);
    }
}
