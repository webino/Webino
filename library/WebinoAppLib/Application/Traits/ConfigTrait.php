<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Application\Traits;

use WebinoAppLib\Application;
use WebinoAppLib\Application\Config;
use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Exception;

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
     * @param string $name
     * @param mixed $service
     */
    abstract protected function setServicesService($name, $service);

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
     * Require service from services into application
     *
     * @param string $service Service name
     * @throws Exception\DomainException Unable to get service
     */
    abstract protected function requireService($service);

    /**
     * @param string|null $name
     * @param mixed|null $default
     * @return Config|mixed
     */
    public function getConfig($name = null, $default = null)
    {
        if (null === $this->config) {
            $this->requireService(Application::CONFIG);
            $this->setServicesService(Application::CONFIG, $this->config);
        }
        return $name ? $this->config->get($name, $default) : $this->config;
    }

    /**
     * @param array|Config|object $config
     * @throws Exception\InvalidArgumentException Expected config as array|Config
     * @throws Exception\DomainException Disallowed config modifications
     */
    public function setConfig($config)
    {
        if (is_array($config)) {
            $this->getConfig()->mergeConfig($config);
            return;
        }

        if (!($config instanceof Config)) {
            throw (new Exception\InvalidArgumentException('Expected config of type %s but got %s'))
                ->format(Config::class, $config);
        }

        if ($this->config && $this->config->isReadOnly()) {
            throw new Exception\DomainException(
                'Unable to set new application configuration; restricted to read only'
            );
        }

        $this->config = $config;
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
