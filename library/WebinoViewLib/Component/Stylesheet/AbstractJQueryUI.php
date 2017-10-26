<?php

namespace WebinoViewLib\Component\Stylesheet;

/**
 * Class AbstractJQueryUI
 */
abstract class AbstractJQueryUI extends Link
{
    /**
     * {@inheritdoc}
     */
    protected function getSpecName()
    {
        return 'jquery-ui-css';
    }
}
