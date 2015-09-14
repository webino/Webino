<?php

namespace WebinoViewLib\Component\Javascript;

/**
 * Class DiffHtmlJQueryV0
 */
class DiffHtmlJQueryV0 extends AbstractDiffHtmlJQuery
{
    public function __construct()
    {
        parent::__construct('//cdn.rawgit.com/webino/diffhtml-jquery/develop/src/diffhtml.jquery.js');
    }

    public function getDependencies()
    {
        return [
            new JQueryV1,
            new DiffDomV0,
        ];
    }
}
