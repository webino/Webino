<?php

namespace WebinoViewLib\Component;

use WebinoViewLib\Feature\NodeView;

/**
 * Class ViewSnippetComponent
 */
class ViewSnippetComponent extends AbstractBaseViewComponent
{
    /**
     * @param NodeView $node
     */
    public function configure(NodeView $node)
    {
        $node
            ->setLocator('view')
            ->setPriority(100)
            ->setSnippet('code', '{$_snippet}')
            ->setReplace('{$code}');
    }
}
