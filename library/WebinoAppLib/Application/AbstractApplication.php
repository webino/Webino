<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Application;

use WebinoAppLib\Contract;
use WebinoAppLib\Service\Bootstrap;
use Zend\ServiceManager\ServiceManager;

/**
 * Class AbstractApplication
 */
abstract class AbstractApplication implements
    AbstractApplicationInterface,
    Contract\ConsoleInterface,
    Contract\DebuggerInterface,
    Contract\ServicesInterface,
    Contract\ConfigInterface,
    Contract\EventsInterface,
    Contract\LoggerInterface,
    Contract\CacheInterface,
    Contract\FilesInterface,
    Contract\RouterInterface,
    Contract\MailerInterface
{
    use Traits\ConsoleTrait;
    use Traits\DebuggerTrait;
    use Traits\ServicesTrait;
    use Traits\ConfigTrait;
    use Traits\EventsTrait;
    use Traits\LoggerTrait;
    use Traits\CacheTrait;
    use Traits\FilesTrait;
    use Traits\RouterTrait;
    use Traits\MailerTrait;

    /**
     * Application bootstrap service name
     */
    const BOOTSTRAP = 'Bootstrap';

    /**
     * @var Bootstrap
     */
    private $bootstrap;

    /**
     * @param ServiceManager $services
     */
    public function __construct(ServiceManager $services)
    {
        $this->services = $services;
    }

    /**
     * @return Bootstrap
     */
    protected function getBootstrap()
    {
        return $this->bootstrap;
    }

    /**
     * @param Bootstrap $bootstrap
     */
    protected function setBootstrap(Bootstrap $bootstrap)
    {
        $this->bootstrap = $bootstrap;
    }
}
