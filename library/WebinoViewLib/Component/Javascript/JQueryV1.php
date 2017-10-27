<?php

namespace WebinoViewLib\Component\Javascript;

/**
 * Class JQueryV1
 */
class JQueryV1 extends AbstractJQuery
{
    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct('//code.jquery.com/jquery-1.11.3.min.js');
    }
}
