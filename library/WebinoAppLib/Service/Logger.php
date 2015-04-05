<?php

namespace WebinoAppLib\Service;

use WebinoAppLib\Exception\DomainException;
use WebinoAppLib\Log\MessageInterface;
use WebinoLogLib\Exception\InvalidArgumentException;
use WebinoLogLib\Logger as LoggerEngine;

/**
 * Class Logger
 */
class Logger implements LoggerInterface
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
     * {@inheritdoc}
     */
    public function log($level, ...$args)
    {
        if (null === $level) {
            return $this->engine;
        }

        $fromClass = ($level instanceof MessageInterface) ? $level : $this->messageFromClass($level);
        if ($fromClass) {
            $_level = $fromClass->getLevel();
            $message = $fromClass->getMessage(...array_values($args));

        } else {
            $_level = $level;
            if (empty($args[0])) {
                throw new InvalidArgumentException('Expected a log message but empty');
            }
            $message = $args[0];
            array_shift($args);
        }

        try {
            $this->engine->log($_level, (string) $message, empty($args['extra']) ? [] : $args['extra']);
        } catch (\Exception $exc) {
            throw new DomainException('Unable to write log', null, $exc);
        }

        return $this->engine;
    }

    /**
     * @param string $className Concrete MessageInterface class class name.
     * @return null|MessageInterface
     */
    private function messageFromClass($className)
    {
        if (class_exists($className)) {
            $message = new $className;
            if ($message instanceof MessageInterface) {
                return $message;
            }

            throw (new InvalidArgumentException('Expected class to be type of %s but got %s'))
                ->format(MessageInterface::class, $message);
        }
        return null;
    }
}
