<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Services;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Webino\Services\Exceptions\ContainerException;
use Webino\Services\Exceptions\NotFoundException;

/**
 * Class ServiceContainerTrait
 */
trait ServiceContainerTrait
{
    /**
     * Container entries
     *
     * @var array
     */
    protected $entries = [];

    /**
     * Configure service container
     *
     * @param array $config Service container config
     * @return void
     */
    public function configure(array $config) : void
    {
        foreach ($config as $key => $value) {

            if (is_numeric($key) && is_string($value)) {
                $this->set($value, $value);

            } elseif (is_string($key)) {
                $this->set($key, $value);
            }
        }
    }

    /**
     * Returns true if the container can return an entry for the given identifier, false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception,
     * it does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $id Identifier of the entry to look for
     * @return bool
     */
    public function has($id)
    {
        return !empty($this->entries[(string) $id]);
    }

    /**
     * Returns entry of the container by its identifier
     *
     * @param string $id Identifier of the entry to look for
     * @throws NotFoundExceptionInterface No entry was found for identifier
     * @throws ContainerExceptionInterface Error while retrieving the entry
     * @return mixed Entry
     */
    public function get($id)
    {
        if (!$this->has($id)) {
            throw (new NotFoundException('Expected entry with id %s'))
                ->format($id);
        }

        $entry = $this->entries[(string) $id];

        try {
            return $this->resolveEntry($entry);
        } catch (\Throwable $exc) {
            throw (new ContainerException('Cannot get valid container entry for id %s', 0, $exc))
                ->format($id);
        }
    }

    /**
     * Set entry
     *
     * @param string $id Entry identifier
     * @param mixed $entry Container entry
     * @return void
     */
    public function set($id, $entry) : void
    {
        $this->entries[(string) $id] = $entry;
    }

    /**
     * @param mixed $entry Container entry
     * @return mixed
     */
    private function resolveEntry($entry)
    {
        if ($this instanceof ServiceContainerInterface) {

            // object or factory class
            if (is_string($entry) && class_exists($entry)) {

                // resolve entry instance or factory
                $isSame = empty($this->entries[$entry]) || $entry === $this->entries[$entry];
                $entry = $isSame ? new $entry : $this->get($entry);

                if ($entry instanceof Factories\FactoryInterface) {
                    return $entry->createService($this);
                }

                return $entry;
            }

            // callback factory
            if (is_callable($entry)) {
                return (new Factories\CallbackFactory($entry))->createService($this);
            }

            if ($entry instanceof Factories\FactoryInterface) {
                return $entry->createService($this);
            }
        }

        return $entry;
    }
}
