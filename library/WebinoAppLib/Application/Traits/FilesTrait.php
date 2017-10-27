<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Application\Traits;

use BsbFlysystem\Service\FilesystemManager;
use League\Flysystem\Filesystem;
use WebinoAppLib\Application;
use WebinoAppLib\Exception\InvalidArgumentException;
use WebinoAppLib\Exception\UnexpectedValueException;
use WebinoAppLib\Filesystem\LocalFiles;

/**
 * Trait Filesystem
 */
trait FilesTrait
{
    /**
     * @var FilesystemManager
     */
    private $filesystems;

    /**
     * Require service from services into application
     *
     * @param string $service Service name
     * @throws \WebinoAppLib\Exception\DomainException Unable to get service
     */
    abstract protected function requireService($service);

    /**
     * Returns filesystem manager
     *
     * @return FilesystemManager
     */
    public function getFiles()
    {
        if (null === $this->filesystems) {
            $this->requireService(Application::FILESYSTEMS);
        }
        return $this->filesystems;
    }

    /**
     * Set filesystem manager
     *
     * @param FilesystemManager $filesystems
     * @return $this
     */
    protected function setFiles(FilesystemManager $filesystems)
    {
        $this->filesystems = $filesystems;
        return $this;
    }

    /**
     * Returns required or default filesystem
     *
     * @param string $adapter Filesystem adapter name
     * @return Filesystem|\WebinoFilesystemLib\Filesystem\FilesystemInterface Required filesystem adapter
     * @throws InvalidArgumentException On invalid adapter argument
     * @throws UnexpectedValueException On invalid return type
     */
    public function file($adapter = null)
    {
        $adapter or $adapter = LocalFiles::class;

        if (!is_string($adapter)) {
            throw (new InvalidArgumentException('Expected adapter as %s but got %s'))
                ->format('string', $adapter);
        }

        $filesystem = $this->getFiles()->get($adapter);
        if ($filesystem instanceof Filesystem) {
            return $filesystem;
        }

        throw (new UnexpectedValueException('Expected filesystem to be instance of %s but got %s'))
            ->format(Filesystem::class, $filesystem);

    }
}
