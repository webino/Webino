<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Webino\Exception\ServiceContainerException;
use Webino\Exception\ServiceNotFoundException;

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
        $id = (string) $id;

        if (!$this->has($id)) {
            if (!class_exists($id)) {
                throw (new ServiceNotFoundException('Expected entry with id %s'))
                    ->format($id);
            }

            array_key_exists($id, $this->entries)
                or $this->entries[$id] = $id;
        }

        try {
            return $this->resolveEntry($this->entries[$id]);
        } catch (\Throwable $exc) {
            throw (new ServiceContainerException('Cannot get valid container entry for id %s', 0, $exc))
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
    public function set(string $id, $entry = null) : void
    {
        $this->entries[(string) $id] = func_num_args() > 1 ? $entry : $id;
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
                $entry = $isSame ? $this->createEntry($entry) : $this->get($entry);

                if ($entry instanceof Factory\FactoryInterface) {
                    return $entry->create($this);
                }

                return $entry;
            }

            // callable factory
            if (is_callable($entry)) {
                return (new Factory\CallbackFactory($entry))->create($this);
            }

            if ($entry instanceof Factory\FactoryInterface) {
                return $entry->create($this);
            }
        }

        return $entry;
    }

    /**
     * @param mixed $entry Container entry
     * @return mixed
     */
    protected function createEntry($entry)
    {
        if (method_exists($entry, 'create')
            && empty(class_implements($entry)[Factory\FactoryInterface::class])
        ) {
            return call_user_func("$entry::create", $this);
        }

        return new $entry;
    }
}
