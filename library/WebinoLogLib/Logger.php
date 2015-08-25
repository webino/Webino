<?php

namespace WebinoLogLib;

use WebinoLogLib\Exception;
use WebinoLogLib\Message\MessageInterface;
use Zend\Stdlib\Parameters;

/**
 * Class Logger
 */
class Logger implements LoggerInterface
{
    /**
     * @var PsrLogger
     */
    private $engine;

    /**
     * @var MessageInterface[]
     */
    private $messages = [];

    /**
     * @param PsrLogger $engine
     */
    public function __construct(PsrLogger $engine)
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
            $_args   = new Parameters(isset($args[0]) ? $args[0] : []);
            $message = $fromClass->getMessage($_args);

        } else {
            $_level = $level;
            if (empty($args[0])) {
                throw new Exception\InvalidArgumentException('Expected a log message but empty');
            }
            $message = $args[0];
            $_args   = new Parameters(isset($args[1]) ? $args[1] : []);
        }

        try {
            $this->engine->log($_level, (string) $message, $_args->toArray());
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
        if (isset($this->messages[$className])) {
            // return cached
            return $this->messages[$className];
        }

        if (class_exists($className)) {
            // create a log message
            $message = new $className;
            if ($message instanceof MessageInterface) {
                $this->messages[$className] = $message;
                return $message;
            }

            throw (new Exception\InvalidArgumentException('Expected class to be type of %s but got %s'))
                ->format(MessageInterface::class, $message);
        }

        return null;
    }
}
