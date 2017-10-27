<?php

namespace WebinoViewLib\Component\Javascript;

/**
 * Class DiffHtmlJQueryV0
 */
class DiffHtmlJQueryV0 extends AbstractDiffHtmlJQuery
{
    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct('//cdn.rawgit.com/webino/diffhtml-jquery/develop/src/diffhtml.jquery.js');
    }

    // TODO interface
    public function getDependencies()
    {
        return [
            new JQueryV1,
            new DiffDomV2,
        ];
    }
}
