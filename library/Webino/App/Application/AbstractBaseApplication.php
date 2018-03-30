<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\App\Application;

use Webino\App\Event\AppEvent;
use Webino\App\Exception\DomainException;
use Webino\App\Exception\InvalidArgumentException;
use Webino\App\Service\Bootstrap;
use Zend\Config\Config;

/**
 * Class AbstractBaseApplication
 */
abstract class AbstractBaseApplication extends AbstractApplication
    implements BaseApplicationInterface
{
    /**
     * {@inheritDoc}
     */
    public function bootstrap()
    {
        if ($this->getConfig()->isReadOnly()) {
            throw new DomainException('Application is already bootstrapped');
        }

        return $this->internalBootstrap(
            $this->getServices()->get($this::BOOTSTRAP),
            function () {
                $this->emit(AppEvent::BOOTSTRAP, $this);
            }
        );
    }

    /**
     * @param object|Bootstrap $bootstrap
     * @param callable $trigger
     * @return AbstractConfiguredApplication
     * @triggers bootstrap
     */
    protected function internalBootstrap(Bootstrap $bootstrap, callable $trigger)
    {
        // lock core config
        $this->getConfig()->get(CoreConfig::CORE)->setReadOnly();

        $bootstrap->attachCoreListeners();
        $listeners = $this->listeners;

        // trigger bootstrap
        call_user_func($trigger);

        // configure application
        $bootstrap->configure();

        $detachedListeners = $this->detachListeners($listeners);
        $bootstrap->attachListeners()->detachCoreListeners();

        // trigger bootstrap again
        call_user_func($trigger);

        $bootstrap->attachCoreListeners();
        $this->attachListeners($detachedListeners);

        // lock config
        $this->getConfig()->setReadOnly();

        // return configured app
        return new ConfiguredApplication($this->getServices());
    }

    /**
     * Detach listeners from application events
     *
     * @param \Zend\EventManager\ListenerAggregateInterface[] $listeners
     * @return \Zend\EventManager\ListenerAggregateInterface[] Detached listeners
     */
    private function detachListeners(array $listeners)
    {
        $detachedListeners = [];

        foreach ($listeners as $listener) {
            $detachedListeners[] = clone $listener;
            $this->unbind($listener);
        }

        return $detachedListeners;
    }

    /**
     * Attach event listeners
     *
     * @param \Zend\EventManager\ListenerAggregateInterface[] $listeners
     */
    private function attachListeners(array $listeners)
    {
        foreach ($listeners as $listener) {
            $this->bind($listener);
        }
    }

    /**
     * Merge config into application config.
     *
     * @param array|Config|null $config
     * @return $this
     * @throws InvalidArgumentException
     */
    public function mergeConfig($config = null)
    {
        if (empty($config)) {
            return $this;
        }

        if (is_object($config) && method_exists($config, 'toArray')) {
            $config = $config->toArray();
        }

        if (is_array($config)) {
            $config = new Config($config);
        }

        if (!($config instanceof Config)) {
            throw new InvalidArgumentException('Expected array|Config|null');
        }

        $this->getConfig()->merge($config);
        return $this;
    }
}
