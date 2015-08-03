<?php

namespace WebinoAppLib\Application\Traits;

use BsbFlysystem\Service\FilesystemManager;
use WebinoAppLib\Application\AbstractApplicationInterface;
use WebinoAppLib\Exception\InvalidArgumentException;
use WebinoAppLib\Filesystem\LocalFiles;

/**
 * Trait Filesystem
 */
trait FilesystemTrait
{
    /**
     * @var FilesystemManager
     */
    private $filesystem;

    /**
     * @param string $name
     * @param mixed $service
     */
    abstract protected function setServicesService($name, $service);

    /**
     * @return FilesystemManager|mixed
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }

    /**
     * @param object|FilesystemManager $filesystem
     * @param bool $setService
     */
    protected function setFilesystem(FilesystemManager $filesystem, $setService = true)
    {
        $this->filesystem = $filesystem;
        $setService and $this->setServicesService(AbstractApplicationInterface::FILESYSTEM, $filesystem);
    }

    /**
     * @param string $adapter Filesystem adapter name
     * @return \WebinoFilesystemLib\Filesystem\FilesystemInterface
     * @throws InvalidArgumentException
     */
    public function file($adapter = LocalFiles::class)
    {
        if (!is_string($adapter)) {
            throw (new InvalidArgumentException('Expected adapter as %s but got %s'))
                ->format('string', $adapter);
        }

        return $this->getFilesystem()->get($adapter);
    }
}
