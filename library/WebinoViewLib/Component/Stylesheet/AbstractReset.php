<?php

namespace WebinoViewLib\Component\Stylesheet;

/**
 * Class AbstractReset
 */
abstract class AbstractReset extends Link
{
    /**
     * {@inheritdoc}
     */
    protected function getSpecName()
    {
        return 'reset-css';
    }
}
