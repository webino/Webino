<?php

namespace WebinoAppLib\Service;

use WebinoAppLib\Application;
use WebinoAppLib\Application\CoreConfig;
use WebinoAppLib\Event\AppEvent;
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
    const CACHE_KEY = 'application';

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

    private function getCacheKey()
    {
        return $this::CACHE_KEY . '_' . md5($this->cacheKey);
    }

    /**
     * @param string $key
     * @return self
     */
    public function setCacheKey($key)
    {
        $this->cacheKey.= (string) $key;
        return $this;
    }

    /**
     * Configures the application
     *
     * Returns cached early if any.
     *
     * @triggers configure
     * @return self
     */
    public function configure()
    {
        $cfg    = $this->app->getConfig();
        // TODO use $this->app->getCache($key);
        $cache  = $cfg->get(ConfigCacheEnabled::KEY) ? $this->app->getCache() : null;
        $key    = $this->getCacheKey();
        $cached = $cache ? $cache->getItem($key) : null;

        if ($cached) {
            $this->app->setConfig($cached);
            // TODO
//            $this->log(Message\LoadCachedAppConfig::class);
            return $this;
        }

        $this->app->emit(AppEvent::CONFIGURE, [], [$this->app, 'mergeConfig']);
        // TODO
//        $this->log(Message\ConfigureApp::class);

        // TODO use $this->app->setCache($key, $cfg);
        $cache and $cache->setItem($key, $cfg);
        $this->configureServices();
        return $this;
    }

    /**
     * Configure application services
     *
     * @return self
     */
    protected function configureServices()
    {
        // TODO use $this->app->getConfig(Config::SERVICES);
        $services = $this->app->getConfig()->get(CoreConfig::SERVICES);
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
     * @return self
     */
    public function attachCoreListeners()
    {
        $this->eachCoreListener([$this, 'attachListener']);
        return $this;
    }

    /**
     * Detach core listeners
     *
     * @return self
     */
    public function detachCoreListeners()
    {
        $this->eachCoreListener([$this, 'detachListener']);
        return $this;
    }

    /**
     * Attach application listeners
     * 
     * @return self
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
        // TODO $this->app->getCoreConfig(Config::LISTENERS);
        $config = $this->app->get(Application::CORE_CONFIG);
        $listeners = $config->get(CoreConfig::LISTENERS);

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
        // TODO use $this->app->getConfig(Config::LISTENERS);
        $listeners = $this->app->getConfig()->get(CoreConfig::LISTENERS);
        if (empty($listeners)) {
            return;
        }

        foreach ($listeners as $listener) {
            call_user_func($callback, $listener);
        }
    }
}
