<?php

namespace WebinoConfigLib;

use ArrayObject;
use Zend\Stdlib\ArrayUtils;

/**
 * Class Config
 */
class AbstractConfig
{
    /**
     * @var ArrayObject
     */
    private $data;

    /**
     * @param array $data
     * @return ArrayObject
     */
    protected function createData(array $data = [])
    {
        return new ArrayObject($data, ArrayObject::ARRAY_AS_PROPS);
    }

    /**
     * @return ArrayObject
     */
    protected function getData()
    {
        if (null === $this->data) {
            $this->data = $this->createData();
        }
        return $this->data;
    }

    /**
     * @param self $merge
     * @return self
     */
    protected function merge(self $merge)
    {
        $this->mergeArray($merge->toArray());
        return $this;
    }

    /**
     * @param array $merge
     * @return self
     */
    protected function mergeArray(array $merge)
    {
        $this->data = $this->createData(ArrayUtils::merge($this->getData()->getArrayCopy(), $merge));
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->getData()->getArrayCopy();
    }
}
