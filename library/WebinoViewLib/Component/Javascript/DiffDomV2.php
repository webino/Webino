<?php

namespace WebinoViewLib\Component\Javascript;

/**
 * Class DiffDomV2
 */
class DiffDomV2 extends AbstractDiffDom
{
    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct('//cdn.jsdelivr.net/npm/diff-dom@2.3.0/diffDOM.js');
    }
}
