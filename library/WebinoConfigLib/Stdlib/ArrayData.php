<?php

namespace WebinoConfigLib\Stdlib;

/**
 * Class ArrayData
 *
 * ArrayObject that works without notices
 * of undefined indexes under the HHVM.
 */
class ArrayData extends \ArrayObject
{
    /**
     * Create an array object as properties
     *
     * @param array $data
     */
    public function __construct($data = [])
    {
        parent::__construct($data, \ArrayObject::ARRAY_AS_PROPS);
    }

    /**
     * Retrieve a value
     *
     * Set an empty array if offset isn't set.
     *
     * @param mixed $index
     * @return mixed
     */
    public function offsetGet($index)
    {
        if (!$this->offsetExists($index)) {
            $this->offsetSet($index, []);
        }
        return parent::offsetGet($index);
    }
}