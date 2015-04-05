<?php

namespace WebinoConfigLib;

use WebinoConfigLib\Stdlib\ArrayData;
use Zend\Stdlib\ArrayUtils;

/**
 * Class Config
 */
class AbstractConfig
{
    /**
     * @var ArrayData
     */
    private $data;

    /**
     * @param array $data
     * @return ArrayData
     */
    protected function createData(array $data = [])
    {
        return new ArrayData($data);
    }

    /**
     * @return ArrayData
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
