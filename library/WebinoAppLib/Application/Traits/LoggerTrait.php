<?php

namespace WebinoAppLib\Application\Traits;

use WebinoConfigLib\Feature\AbstractLog;
use WebinoLogLib\LoggerInterface;
use WebinoLogLib\Factory;
use WebinoLogLib\Message\MessageInterface;

/**
 * Trait Logger
 */
trait LoggerTrait
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var LoggerInterface[]
     */
    private $loggers;

    /**
     * Return registered service
     *
     * @param string $service Service name
     * @return mixed
     * @throws \WebinoAppLib\Exception\UnknownServiceException
     */
    abstract public function get($service);

    /**
     * @param string|null $name
     * @param mixed|null $default
     * @return \Zend\Config\Config|mixed
     */
    abstract public function getConfig($name = null, $default = null);

    /**
     * @param string $name
     * @return object|LoggerInterface
     */
    public function getLogger($name = null)
    {
        if (null === $name) {
            return $this->logger;
        }
        return $this->resolveLogger($name);
    }

    /**
     * @param string $name
     * @return LoggerInterface
     */
    private function resolveLogger($name)
    {
        if (isset($this->loggers[$name])) {
            return $this->loggers[$name];
        }

        /** @var \Zend\Config\Config $options */
        $options = $this->getConfig(AbstractLog::KEY)->{$name};
        $logger  = $this->get(Factory::class)->create($options->toArray());

        $this->loggers[$name] = $logger;
        return $logger;
    }

    /**
     * @param LoggerInterface $logger
     */
    protected function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Write a message to a log
     *
     * @param string|MessageInterface|null $level Message severity or a MessageInterface class name or an object.
     * @param mixed ...$args Message parameters, if $level is a string the first argument is a message text.
     * @return \Psr\Log\LoggerInterface
     */
    public function log($level = null, ...$args)
    {
        return $this->getLogger()->log($level, ...$args);
    }
}
