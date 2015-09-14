<?php

namespace WebinoViewLib\Component\Stylesheet;

/**
 * Class AbstractBootstrap
 */
abstract class AbstractBootstrap extends Link
{
    /**
     * {@inheritdoc}
     */
    protected function getSpecName()
    {
        return 'bootstrap-css';
    }
}
