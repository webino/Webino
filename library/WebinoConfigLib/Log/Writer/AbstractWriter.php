<?php

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
