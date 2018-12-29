<?php

namespace Webino;

use Psr\Log\LogLevel;
use Tracy\Debugger;

/**
 * Trait LoggerTrait
 * @package webino-app
 */
trait LoggerTrait
{
    /**
     * Log to debug levels mapping
     *
     * @var array
     */
    static $debugLevels = [
        LogLevel::EMERGENCY => Debugger::CRITICAL,
        LogLevel::ALERT => Debugger::WARNING,
        LogLevel::CRITICAL => Debugger::CRITICAL,
        LogLevel::ERROR => Debugger::ERROR,
        LogLevel::WARNING => Debugger::WARNING,
        LogLevel::NOTICE => Debugger::INFO,
        LogLevel::INFO => Debugger::INFO,
        LogLevel::DEBUG => Debugger::DEBUG,
    ];

    /**
     * Log to user levels mapping
     *
     * @var array
     */
    static $userLevels = [
        LogLevel::EMERGENCY => E_USER_WARNING,
        LogLevel::ALERT => E_USER_WARNING,
        LogLevel::CRITICAL => E_USER_WARNING,
        LogLevel::ERROR => E_USER_WARNING,
        LogLevel::WARNING => E_USER_WARNING,
        LogLevel::NOTICE => E_USER_NOTICE,
        LogLevel::INFO => E_USER_NOTICE,
        LogLevel::DEBUG => null,
    ];

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws \Psr\Container\NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws \Psr\Container\ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed Entry.
     */
    abstract function get($id);

    /**
     * Returns logger service
     *
     * @return AppLogger
     */
    private function getLogger(): AppLogger
    {
        return $this->get(AppLogger::class);
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function emergency($message, array $context = []): void
    {
        $this->getLogger()->emergency($this->handleMessage($message, LogLevel::EMERGENCY), $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function alert($message, array $context = []): void
    {
        $this->getLogger()->alert($this->handleMessage($message, LogLevel::ALERT), $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function critical($message, array $context = []): void
    {
        $this->getLogger()->critical($this->handleMessage($message, LogLevel::CRITICAL), $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function error($message, array $context = []): void
    {
        $this->getLogger()->error($this->handleMessage($message, LogLevel::ERROR), $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function warning($message, array $context = []): void
    {
        $this->getLogger()->warning($this->handleMessage($message, LogLevel::WARNING), $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function notice($message, array $context = []): void
    {
        $this->getLogger()->notice($this->handleMessage($message, LogLevel::NOTICE), $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function info($message, array $context = []): void
    {
        $this->getLogger()->info($this->handleMessage($message, Debugger::INFO), $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function debug($message, array $context = []): void
    {
        $this->getLogger()->debug($this->handleMessage($message, Debugger::DEBUG), $context);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function log($level, $message, array $context = []): void
    {
        $this->getLogger()->log($level, $this->handleMessage($message, $level), $context);
    }

    /**
     * Handle message exceptions
     *
     * @param mixed $message
     * @param string $level
     * @return string
     */
    private function handleMessage($message, string $level): string
    {
        if ($message instanceof \Throwable) {

            Debugger::log($message, LoggerTrait::$debugLevels[$level] ?? Debugger::ERROR);

            (!Debugger::$strictMode && LoggerTrait::$userLevels[$level] ?? false)
                and trigger_error($message->getMessage() ?: get_class($message), LoggerTrait::$userLevels[$level]);

            return $message->getMessage() ?: get_class($message);
        }

        return $message;
    }
}
