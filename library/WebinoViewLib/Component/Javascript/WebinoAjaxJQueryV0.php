<?php

namespace WebinoViewLib\Component\Javascript;

/**
 * Class WebinoAjaxJQueryV0
 */
class WebinoAjaxJQueryV0 extends AbstractWebinoAjaxJQuery
{
    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct('//cdn.rawgit.com/webino/webino-ajax-jquery/develop/src/webino.ajax.jquery.js');
    }

    // TODO interface
    public function getDependencies()
    {
        return [new DiffHtmlJQueryV0];
    }
}
