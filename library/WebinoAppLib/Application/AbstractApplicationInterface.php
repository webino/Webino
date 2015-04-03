<?php

namespace WebinoAppLib\Application;

use WebinoAppLib\Service\DebuggerInterface;
use Zend\Cache\Storage\StorageInterface;
use Zend\Config\Config;
use Zend\EventManager\EventManager;
use Zend\Log\LoggerInterface;
use Zend\ServiceManager;
use Zend\ServiceManager\ServiceManager as Services;
use Zend\Stdlib\RequestInterface;
use Zend\Stdlib\ResponseInterface;

/**
 * Interface AbstractApplicationInterface
 */
interface AbstractApplicationInterface
{
    /**
     * Application service name
     */
    const SERVICE = 'Application';

    /**
     * Application events service name
     */
    const EVENTS = 'Events';

    /**
     * Application debugger service name
     */
    const DEBUGGER = 'Debugger';

    /**
     * Application logger service name
     */
    const LOGGER = 'Logger';

    /**
     * Application cache service name
     */
    const CACHE = 'Cache';

    /**
     * Application core configuration service name
     */
    const CORE_CONFIG = 'CoreConfig';

    /**
     * Application configuration service name
     */
    const CONFIG = 'Config';

    /**
     * Application request service name
     */
    const REQUEST = 'Request';

    /**
     * Application response service name
     */
    const RESPONSE = 'Response';

    /**
     * @return Services
     */
    public function getServices();

    /**
     * @return Config
     */
    public function getConfig();

    /**
     * @return EventManager
     */
    public function getEvents();

    /**
     * @return RequestInterface
     */
    public function getRequest();

    /**
     * @param object|RequestInterface $request
     */
    public function setRequest(RequestInterface $request);

    /**
     * @return ResponseInterface
     */
    public function getResponse();

    /**
     * @param object|ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response);

    /**
     * @return object|DebuggerInterface
     */
    public function getDebugger();

    /**
     * @return object|LoggerInterface
     */
    public function getLogger();

    /**
     * @return StorageInterface
     */
    public function getCache();
}
