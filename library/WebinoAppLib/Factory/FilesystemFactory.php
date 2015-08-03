<?php

namespace WebinoAppLib\Factory;

use BsbFlysystem\Service\Factory\AdapterManagerFactory;
use BsbFlysystem\Service\FilesystemManager;
use WebinoAppLib\Application;
use WebinoAppLib\Exception;
use WebinoBaseLib\Service\SimpleServiceContainer;
use Zend\Log\Exception\InvalidArgumentException;

/**
 * Class FilesystemFactory
 */
class FilesystemFactory extends AbstractFactory
{
    /**
     * Application configuration key
     */
    const KEY = 'filesystem';

    /**
     * Create a filesystem
     *
     * @return \BsbFlysystem\Service\AdapterManager
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
