<?php

namespace WebinoViewLib\Component;

use WebinoViewLib\Feature\NodeView;

/**
 * Class AjaxFragmentComponent
 */
class AjaxFragmentComponent extends AbstractBaseViewComponent
{
    /**
     * @param NodeView $node
     */
    public function configure(NodeView $node)
    {
        $node
            ->setPriority(-100)
            ->setLocator('xpath=//*[contains(@class, "ajax-fragment") and not(@id)]')
            ->setVar('id', 'md5', ['{$_nodePath}'])
            ->setAttribute('id', 'n{$id}');
    }
}
