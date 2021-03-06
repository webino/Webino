<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Factory;

use BsbFlysystem\Service\Factory\AdapterManagerFactory;
use BsbFlysystem\Service\FilesystemManager;
use WebinoAppLib\Exception;
use WebinoBaseLib\Service\SimpleServiceContainer;
use Zend\Log\Exception\InvalidArgumentException;

/**
 * Class FilesystemsFactory
 */
class FilesystemsFactory extends AbstractFactory
{
    /**
     * Application configuration key
     */
    const KEY = 'filesystem';

    /**
     * Create a filesystem
     *
     * @return FilesystemManager
     * @throws Exception\InvalidArgumentException Unable to create a logger
     */
    protected function create()
    {
        $services = new SimpleServiceContainer;
        $services->set('config', $this->getConfig()->toArray());

        try {
            $adapterManager = (new AdapterManagerFactory)->createService($services);
        } catch (InvalidArgumentException $exc) {
            throw new Exception\InvalidArgumentException('Unable to create a filesystem', null, $exc);
        }

        $adapterManager->setServiceLocator($services);
        $services->set('BsbFlysystemAdapterManager', $adapterManager);

        $filesystemManager = new FilesystemManager;
        $filesystemManager->setServiceLocator($services);

        return $filesystemManager;
    }
}
