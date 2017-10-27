<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoConfigLib\Log\Writer;

use WebinoConfigLib\AbstractConfig;

/**
 * Class AbstractWriter
 */
abstract class AbstractWriter extends AbstractConfig
{
    /**
     * @param string $name
     * @param array $options
     */
    public function setFormatter($name, array $options = [])
    {
        $this->mergeArray([
            'options' => [
                'formatter' => [
                    'name'    => $name,
                    'options' => $options,
                ],
            ],
        ]);
    }

    /**
     * @param string $name
     * @param array $options
     */
    public function setFilter($name, array $options = [])
    {
        $this->mergeArray([
            'options' => [
                'filters' => [
                    $name => [
                        'name'    => $name,
                        'options' => $options,
                    ],
                ],
            ],
        ]);
    }
}
