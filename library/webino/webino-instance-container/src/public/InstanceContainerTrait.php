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

/**
 * Class InstanceContainerTrait
 * @package webino-instance-container
 */
trait InstanceContainerTrait
{
    /**
     * Container entries
     *
     * @var iterable
     */
    protected $entries = [];

    /**
     * Entries factories
     *
     * @var iterable
     */
    protected $factories = [];

    /**
     * @var iterable
     */
    protected $instances = [];

    /**
     * Returns true if the container can return an entry for the given identifier, false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception,
     * it does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $id Identifier of the entry to look for
     * @return bool
     */
    function has($id)
    {
        return !empty($this->entries[(string) $id]);
    }

    /**
     * Returns entry of the container by its identifier
     *
     * @param string $id Identifier of the entry to look for
     * @throws InstanceNotFoundException No entry was found for identifier
     * @throws InstanceContainerException Error while retrieving the entry
     * @return mixed Entry
     */
    function get($id)
    {
        $id = (string) $id;

        if (isset($this->instances[$id])) {
            return $this->instances[$id];
        }

        try {
            return $this->instances[$id] = $this->create($id);
        } catch (\Throwable $exc) {
            throw (new InstanceContainerException('Cannot get valid instance for id %s;', 0, $exc))
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
    function set(string $id, $entry = null): void
    {
        $this->entries[(string) $id] = func_num_args() > 1 ? $entry : $id;
    }

    /**
     * Creates new instance
     *
     * @param string $id Instance id
     * @param array $parameter Optional parameters
     * @throws InstanceNotFoundException No entry was found for identifier
     * @throws InstanceContainerException Error while retrieving the entry
     * @return mixed New instance
     */
    function create(string $id, ...$parameter)
    {
        if (!$this->has($id)) {
            $class = $id;
            if (interface_exists($id)) {
                // get default implementation class name from interface
                $class = substr($id, 0, strlen($id) - 9);

            }
            if (!class_exists($class)) {
                throw (new InstanceNotFoundException('Expected entry with id %s;'))
                    ->format($class);
            }

            array_key_exists($id, $this->entries)
                or $this->entries[$id] = [Factory\MethodFactory::class, $class];
        }

        try {

            list($factoryClass, $class) = $this->entries[$id];

            $factory = $this->getFactory($factoryClass);

            $event = new CreateInstanceEvent($this, $class, $parameter);
            if (method_exists($this, 'createInstanceEvent')) {
                $event = $this->createInstanceEvent($event);
            }

            return $factory->createInstance($event);


        } catch (\Throwable $exc) {
            throw (new InstanceContainerException('Cannot create valid instance for class %s', 0, $exc))
                ->format($class);
        }
    }

    /**
     * Returns instance factory
     *
     * @param string $factoryClass
     * @return InstanceFactoryInterface
     */
    protected function getFactory(string $factoryClass): InstanceFactoryInterface
    {
        empty($this->factories[$factoryClass]) and $this->factories[$factoryClass] = new $factoryClass($this);
        return $this->factories[$factoryClass];
    }
}
