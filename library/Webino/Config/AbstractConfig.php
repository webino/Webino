<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Config;

use ArrayObject;
use Webino\Base\Util\ToArrayInterface;
use Zend\Stdlib\ArrayUtils;

/**
 * Class Config
 */
class AbstractConfig implements ToArrayInterface
{
    /**
     * @var ArrayObject
     */
    private $data;

    /**
     * @param array $data
     * @return ArrayObject
     */
    protected function createData(array $data = []) : ArrayObject
    {
        return new ArrayObject($data, ArrayObject::ARRAY_AS_PROPS);
    }

    /**
     * @return ArrayObject
     */
    protected function getData() : ArrayObject
    {
        if (null === $this->data) {
            $this->data = $this->createData();
        }
        return $this->data;
    }

    /**
     * @param ToArrayInterface $merge
     * @return $this
     */
    protected function merge(ToArrayInterface $merge) : self
    {
        $this->mergeArray($merge->toArray());
        return $this;
    }

    /**
     * @param array $merge
     * @return $this
     */
    protected function mergeArray(array $merge) : self
    {
        $this->data = $this->createData(ArrayUtils::merge($this->getData()->getArrayCopy(), $merge));
        return $this;
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return $this->getData()->getArrayCopy();
    }
}
