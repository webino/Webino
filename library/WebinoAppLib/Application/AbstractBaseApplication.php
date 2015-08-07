<?php

namespace WebinoAppLib\Application;

use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Exception\DomainException;
use WebinoAppLib\Exception\InvalidArgumentException;
use WebinoAppLib\Service\Bootstrap;
use Zend\Config\Config;
use Zend\ServiceManager;

/**
 * Class AbstractBaseApplication
 */
abstract class AbstractBaseApplication extends AbstractApplication
    implements BaseApplicationInterface
{
    /**
     * @var \Zend\EventManager\ListenerAggregateInterface[]
     */
    private $detachedListeners = [];

    /**
     * {@inheritDoc}
     */
    public function bootstrap()
    {
        if ($this->getConfig()->isReadOnly()) {
            throw new DomainException('The application is already bootstrapped');
        }

        return $this->internalBootstrap(
            $this->getServices()->get($this::BOOTSTRAP),
            function () {
                $this->emit(AppEvent::BOOTSTRAP, $this);
            }
        );
    }

    /**
     * @triggers bootstrap
     * @param object|Bootstrap $bootstrap
     * @param callable $trigger
     * @return AbstractConfiguredApplication
     */
    protected function internalBootstrap(Bootstrap $bootstrap, callable $trigger)
    {
        // lock core config
        $this->getConfig()->get(CoreConfig::CORE)->setReadOnly();

        // trigger bootstrap
        $bootstrap->attachCoreListeners();
        call_user_func($trigger);

        // configure application
        $bootstrap->configure();

        // trigger bootstrap again
        $this->detachListeners();
        $bootstrap->attachListeners()->detachCoreListeners();
        call_user_func($trigger);
        $bootstrap->attachCoreListeners();
        $this->attachDetachedListeners();

        // lock config
        $this->getConfig()->setReadOnly();

        // return configured app
        return new ConfiguredApplication($this->getServices());
    }

    /**
     * Detach listeners from application events
     */
    private function detachListeners()
    {
        $this->detachedListeners = [];
        foreach ($this->listeners as $listener) {
            $this->detachedListeners[] = clone $listener;
            $this->unbind($listener);
        }
    }

    /**
     * Attach previously detached event listeners
     */
    private function attachDetachedListeners()
    {
        foreach ($this->detachedListeners as $listener) {
            $this->bind($listener);
        }
    }

    /**
     * Merge config into application config.
     *
     * @param array|Config|null $config
     * @return self
     * @throws InvalidArgumentException
     */
    public function mergeConfig($config = null)
    {
        if (empty($config)) {
            return;
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
    }
}
