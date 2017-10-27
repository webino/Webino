<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoConfigLib\Mail\Transport;

use WebinoConfigLib\AbstractConfig;

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
