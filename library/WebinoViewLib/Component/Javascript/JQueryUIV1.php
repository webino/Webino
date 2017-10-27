<?php

namespace WebinoViewLib\Component\Javascript;

/**
 * Class JQueryUIV1
 */
class JQueryUIV1 extends AbstractJQueryUI
{
    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct('//code.jquery.com/ui/1.12.1/jquery-ui.js');
    }
}
