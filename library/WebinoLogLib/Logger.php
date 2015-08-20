<?php

namespace WebinoLogLib;

use WebinoLogLib\Exception;
use WebinoLogLib\Message\MessageInterface;

/**
 * Class Logger
 */
class Logger implements LoggerInterface
{
    /**
     * @var BaseLogger
     */
    private $engine;

    /**
     * @param BaseLogger $engine
     */
    public function __construct(BaseLogger $engine)
    {
        $this->engine = $engine;
    }

    /**
     * {@inheritdoc}
     */
    public function log($level = null, ...$args)
    {
        if (null === $level) {
            return $this->engine;
        }

        $fromClass = ($level instanceof MessageInterface) ? $level : $this->messageFromClass($level);
        if ($fromClass) {
            $_level  = $fromClass->getLevel();
            $_args   = isset($args[0]) ? $args[0] : [];
            $message = $fromClass->getMessage($_args);

        } else {
            $_level = $level;
            if (empty($args[0])) {
                throw new Exception\InvalidArgumentException('Expected a log message but empty');
            }
            $message = $args[0];
            $_args   = isset($args[1]) ? $args[1] : [];
        }

        try {
            $this->engine->log($_level, (string) $message, $_args);
        } catch (\Exception $exc) {
            throw new Exception\DomainException('Unable to write log', null, $exc);
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

            throw (new Exception\InvalidArgumentException('Expected class to be type of %s but got %s'))
                ->format(MessageInterface::class, $message);
        }
        return null;
    }
}
