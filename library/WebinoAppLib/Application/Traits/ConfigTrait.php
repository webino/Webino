<?php

namespace WebinoAppLib\Application\Traits;

use WebinoAppLib\Application;
use WebinoAppLib\Application\AbstractApplicationInterface;
use WebinoAppLib\Application\Config;
use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Exception\DomainException;

/**
 * Trait Config
 */
trait ConfigTrait
{
    /**
     * @var Config
     */
    private $config;

    /**
     * Return registered service
     *
     * @param string $service Service name
     * @return mixed
     */
    abstract public function get($service);

    /**
     * Attach a listener to an event
     *
     * @param string|\Zend\EventManager\ListenerAggregateInterface $event
     * @param string|callable|int $callback If string $event provided, expects PHP callback;
     * @param int $priority Invocation priority
     * @return \Zend\Stdlib\CallbackHandler|mixed CallbackHandler if attaching callable
     *                          (to allow later unsubscribe); mixed if attaching aggregate
     */
    abstract public function bind($event, $callback = null, $priority = 1);

    /**
     * @param string $name
     * @param mixed $service
     */
    abstract protected function setServicesService($name, $service);

    /**
     * @param string|null $name
     * @param mixed|null $default
     * @return Config|mixed
     */
    public function getConfig($name = null, $default = null)
    {
        return $name ? $this->config->get($name, $default) : $this->config;
    }

    /**
     * @param array|Config|object $config
     * @param bool $setService
     * @throws DomainException Disallowed config modifications
     */
    public function setConfig($config, $setService = true)
    {
        if (is_array($config)) {
            $this->getConfig()->mergeConfig($config);
            return;
        }

        if (!($config  instanceof Config)) {
            // TODO exception
        }

        if ($this->config && $this->config->isReadOnly()) {
            throw new DomainException(
                'Unable to set new application configuration; restricted to read only'
            );
        }

        $this->config = $config;
        $setService and $this->setServicesService(AbstractApplicationInterface::CONFIG, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function getCoreConfig($name = null, $default = null)
    {
        $config = $this->get(Application::CORE_CONFIG);
        return $name ? $config->get($name, $default) : $config;
    }

    /**
     * @param callable $callback
     */
    public function onConfig(callable $callback)
    {
        $this->bind(AppEvent::CONFIGURE, function (AppEvent $event) use ($callback) {
            $event->getApp()->setConfig(call_user_func($callback));
        });
    }
}
