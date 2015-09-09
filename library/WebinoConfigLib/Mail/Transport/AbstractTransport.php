<?php

namespace WebinoConfigLib\Mail\Transport;

use WebinoConfigLib\AbstractConfig;
use WebinoConfigLib\Exception\InvalidArgumentException;
use Zend\Stdlib\ArrayUtils;

/**
 * Class AbstractTransport
 */
abstract class AbstractTransport extends AbstractConfig
{
    /**
     * @param string $type
     */
    protected function setType($type)
    {
        $this->mergeArray(['type' => (string) $type]);
    }

    /**
     * @param array $options
     */
    protected function setOptions(array $options)
    {
        $this->mergeArray(['options' => $options]);
    }
}
