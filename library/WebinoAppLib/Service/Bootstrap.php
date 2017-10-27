<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Service;

use WebinoAppLib\Application;
use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Feature\Config;
use WebinoAppLib\Log;
use WebinoConfigLib\Feature\ConfigCacheEnabled;
use Zend\ServiceManager\Config as ServicesConfig;

/**
 * Application bootstrap
 */
class Bootstrap
{
    /**
     * Application configuration cache key
     */
    const CACHE_KEY = 'config';

    /**
     * @var Application
     */
    private $app;

    /**
     * @var string
     */
    private $cacheKey;

    /**
     * @param object|Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @return string
     */
    private function getCacheKey()
    {
        return $this::CACHE_KEY . '_' . $this->cacheKey;
    }

    /**
     * @param string $key
     * @return $this
     */
    public function setCacheKey($key)
    {
        $this->cacheKey .= md5($key);
        return $this;
    }

    /**
     * Configures the application
     *
     * Returns cached early if any.
     *
     * @triggers configure
     * @return $this
     */
    public function configure()
    {
        $config   = $this->app->getConfig();
        $useCache = $this->app->getConfig(ConfigCacheEnabled::KEY);

        if ($useCache) {
            $cached = $this->app->getCache($this->getCacheKey());
            if ($cached) {
                $this->app->setConfig($cached);
                $this->configureServices();
                $this->app->log(Log\LoadCachedAppConfig::class);
                return $this;
            }
        }

        $this->app->emit(AppEvent::CONFIGURE, [], [$this->app, 'mergeConfig']);
        $this->configureServices();
        $this->app->log(Log\ConfigureApp::class);

        $useCache and $this->app->setCache($this->getCacheKey(), $config);

        return $this;
    }

    /**
     * Configure application services
     *
     * @return $this
     */
    protected function configureServices()
    {
        $services = $this->app->getConfig(Config::SERVICES);
        if (null === $services) {
            return $this;
        }

        $config = $services->toArray();
        (new ServicesConfig($config))->configureServiceManager($this->app->getServices());
        return $this;
    }

    /**
     * Attach core listeners
     *
     * @return $this
     */
    public function attachCoreListeners()
    {
        $this->eachCoreListener([$this, 'attachListener']);
        return $this;
    }

    /**
     * Detach core listeners
     *
     * @return $this
     */
    public function detachCoreListeners()
    {
        $this->eachCoreListener([$this, 'detachListener']);
        return $this;
    }

    /**
     * Attach application listeners
     * 
     * @return $this
     */
    public function attachListeners()
    {
        $this->eachListener([$this, 'attachListener']);
        return $this;
    }

    /**
     * @param $listener
     */
    protected function attachListener($listener)
    {
        $service = $this->app->get($listener);
        $service and $this->app->bind($service);
    }

    /**
     * @param $listener
     */
    protected function detachListener($listener)
    {
        $service = $this->app->get($listener);
        $service and $this->app->unbind($service);
    }

    /**
     * @param callable $callback
     */
    protected function eachCoreListener(callable $callback)
    {
        $listeners = $this->app->getCoreConfig(Config::LISTENERS);
        if (empty($listeners)) {
            return;
        }

        foreach ($listeners as $listener) {
            call_user_func($callback, $listener);
        }
    }

    /**
     * @param callable $callback
     */
    protected function eachListener(callable $callback)
    {
        $listeners = $this->app->getConfig(Config::LISTENERS);
        if (empty($listeners)) {
            return;
        }

        foreach ($listeners as $listener) {
            call_user_func($callback, $listener);
        }
    }
}
