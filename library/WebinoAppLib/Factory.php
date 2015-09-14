<?php

namespace WebinoAppLib;

use WebinoAppLib\Application;
use WebinoAppLib\Application\AbstractApplication;
use WebinoAppLib\Application\Config;
use WebinoAppLib\Application\CoreConfig;
use WebinoAppLib\Exception\DomainException;
use WebinoAppLib\Exception\InvalidArgumentException;
use WebinoAppLib\Service\DebuggerInterface;
use Zend\ServiceManager\ServiceManager;

/**
 * Class Factory
 */
class Factory
{
    /**
     * Application debugger file path
     */
    const DEBUGGER_PATH = 'config/debugger.php';

    /**
     * Application configuration file path
     */
    const CONFIG_PATH = 'config/application.php';

    /**
     * @param array|object $config
     * @param DebuggerInterface $debugger
     * @return Application\AbstractBaseApplication
     */
    public function create($config = null, DebuggerInterface $debugger = null)
    {
        $_debugger = $this->createDebugger($debugger);
        $_config   = $this->createConfig($config);

        $services = $this->createServices($_config);
        $services->setService(Application::DEBUGGER, $_debugger);

        $app = $services->get(Application::SERVICE);
        if (!($app instanceof AbstractApplication)) {
            throw (new DomainException('Expected application type %s but got %s'))
                ->format(AbstractApplication::class, get_class($app));
        }

        return $app;
    }

    /**
     * @param DebuggerInterface $debugger
     * @return mixed|DebuggerInterface|\WebinoAppLib\Service\NullDebugger
     */
    protected function createDebugger(DebuggerInterface $debugger = null)
    {
        if (null !== $debugger) {
            return $debugger;
        }

        $filePath = $this::DEBUGGER_PATH;
        if (!@stream_resolve_include_path($filePath)) {
            return $debugger;
        }

        /** @noinspection PhpIncludeInspection */
        $created = require $filePath;
        if (null === $created) {
            return null;
        }
        if (!($created instanceof DebuggerInterface)) {
            throw (new DomainException('Expected type of included debugger is %s but got %s'))
                ->format(DebuggerInterface::class, get_class($created));
        }

        return $created;
    }

    /**
     * @param array|Config $config
     * @return array
     */
    protected function normalizeConfig($config)
    {
        if (null === $config) {
            return [];
        }
        if (is_array($config)) {
            return $config;
        }
        if (method_exists($config, 'toArray')) {
            return $config->toArray();
        }

        throw (new InvalidArgumentException('Expected config as %s but got %s'))
            ->format('array or object with toArray() method', $config);
    }

    /**
     * @param array|Config|null $config
     * @return Config
     * @throws InvalidArgumentException
     */
    protected function createConfig($config)
    {
        if (null !== $config) {
            $normalized = $this->normalizeConfig($config);
        }

        $filePath = $this::CONFIG_PATH;
        if (@stream_resolve_include_path($filePath)) {
            /** @noinspection PhpIncludeInspection */
            $normalized = $this->normalizeConfig(require $filePath);
        }

        if (empty($normalized)) {
            $normalized = (new CoreConfig)->toArray();
        }

        return new Config($normalized, true);
    }

    /**
     * @param Config $config
     * @return ServiceManager
     */
    private function createServices(Config $config)
    {
        /** @var Config $coreConfig */
        $coreConfig = $config->get(CoreConfig::CORE);
        if (null === $coreConfig) {
            throw (new DomainException('Expected %s node in the application config'))
                ->format(CoreConfig::CORE);
        }

        $servicesConfig = $coreConfig->get(CoreConfig::SERVICES);
        if (null === $servicesConfig) {
            throw (new DomainException('Expected %s node in the application %s config node'))
                ->format(CoreConfig::SERVICES, CoreConfig::CORE);
        }

        $services = new ServiceManager;
        $this->configureServices($services, $coreConfig);

        $services->setService(Application::CORE_CONFIG, $coreConfig);
        $services->setService(Application::CONFIG, $config);

        return $services;
    }

    /**
     * Configure service manager invokables and factories only
     *
     * @param ServiceManager $services
     * @param Config $coreConfig
     */
    private function configureServices(ServiceManager $services, Config $coreConfig)
    {
        $config = $coreConfig[CoreConfig::SERVICES];

        if (!empty($config[CoreConfig::INVOKABLES])) {
            foreach ($config[CoreConfig::INVOKABLES] as $name => $service) {
                $services->setInvokableClass($name, $service);
            }
        }

        if (!empty($config[CoreConfig::FACTORIES])) {
            foreach ($config[CoreConfig::FACTORIES] as $name => $service) {
                $services->setFactory($name, $service);
            }
        }

        if (!empty($config[CoreConfig::INITIALIZERS])) {
            foreach ($config[CoreConfig::INITIALIZERS] as $initializer) {
                $services->addInitializer($initializer);
            }
        }
    }
}
