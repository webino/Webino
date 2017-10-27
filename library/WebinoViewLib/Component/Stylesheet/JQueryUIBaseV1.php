<?php

namespace WebinoViewLib\Component\Stylesheet;

/**
 * Class JQueryUIV1
 */
class JQueryUIBaseV1 extends AbstractBootstrap
{
    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
    }
}
