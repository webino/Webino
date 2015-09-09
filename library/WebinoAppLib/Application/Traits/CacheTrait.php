<?php

namespace WebinoAppLib\Application\Traits;

use WebinoAppLib\Application;
use WebinoAppLib\Exception\DomainException;
use Zend\Cache\Storage\Adapter\BlackHole;
use Zend\Cache\Storage\StorageInterface;

/**
 * Trait Cache
 */
trait CacheTrait
{
    /**
     * @var StorageInterface
     */
    private $cache;

    /**
     * Set optional service from services into application
     *
     * @param string $service Service name
     */
    abstract protected function optionalService($service);

    /**
     * {@inheritdoc}
     */
    public function getCache($key = null)
    {
        if (null === $this->cache) {
            $this->optionalService(Application::CACHE);
            if (null === $this->cache) {
                $this->setCache(new BlackHole);
            }
        }

        if ($key) {
            return $this->cache->getItem($key);
        }
        return $this->cache;
    }

    /**
     * {@inheritdoc}
     */
    public function setCache($cacheOrKey, $value = null)
    {
        if ($cacheOrKey instanceof StorageInterface) {
            if (null !== $this->cache) {
                throw (new DomainException('Unable to set cache; already set'));
            }

            $this->cache = $cacheOrKey;

        } else {
            $this->getCache()->setItem($cacheOrKey, $value);
        }
    }
}
