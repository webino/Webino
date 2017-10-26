<?php

namespace WebinoViewLib\Component\Javascript;

use WebinoViewLib\Feature\NodeView;

/**
 * Class JQueryUIV1
 */
class JQueryUIV1 extends AbstractJQueryUI
{
    public function __construct()
    {
        parent::__construct('//code.jquery.com/ui/1.12.1/jquery-ui.js');
    }

    public function configure(NodeView $node)
    {
        parent::configure($node);

        $node->setHtml($node->getHtml() . '<script>$( function() {
    $( ".accordion" ).accordion({
    heightStyle: "content"
    });
  } );</script>');
    }


}
