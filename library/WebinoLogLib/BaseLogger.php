<?php

namespace WebinoLogLib;

use Psr\Log\AbstractLogger;
use WebinoLogLib\Exception\InvalidArgumentException;
use Zend\Log\Logger as LoggerEngine;

/**
 * Class BaseLogger
 */
final class BaseLogger extends AbstractLogger implements
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
            $this->interpolate($this->normalizeMessage($message), $context),
            isset($context['extra']) ? $context['extra'] : []
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

    /**
     * @param string $val
     * @return string
     */
    private function normalizeValue($val)
    {
        if (is_string($val) || is_numeric($val)) {
            return '`' . $val . '`';
        } elseif (is_object($val)) {
            return '`' . get_class($val) . '`';
        }
        return print_r($val, true);
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
            $replace['{' . $key . '}'] = $this->normalizeValue($val);
        }
        return strtr($message, $replace);
    }
}
