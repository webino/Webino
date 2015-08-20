<?php

namespace WebinoAppLib\Application\Traits;

use BsbFlysystem\Service\FilesystemManager;
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
    private $filesystems;

    /**
     * @return FilesystemManager|mixed
     */
    public function getFilesystems()
    {
        return $this->filesystems;
    }

    /**
     * @param object|FilesystemManager $filesystems
     */
    protected function setFilesystems(FilesystemManager $filesystems)
    {
        $this->filesystems = $filesystems;
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

        return $this->getFilesystems()->get($adapter);
    }
}
