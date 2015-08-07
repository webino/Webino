<?php

namespace WebinoAppLib\Application\Traits;

use WebinoAppLib\Application\AbstractApplicationInterface;
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
     * @param string $name
     * @param mixed $service
     */
//    abstract protected function setServicesService($name, $service);

    /**
     * {@inheritdoc}
     */
    public function getCache($key = null)
    {
        if (null === $this->cache) {
            $this->setCache(new BlackHole);
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
