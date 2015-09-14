<?php

namespace WebinoAppLib\Factory\View;

use WebinoAppLib\Factory\AbstractFactory;
use WebinoViewLib\Listener\SnippetsListener;
use WebinoViewLib\ViewTemplates;

/**
 * Class SnippetsListenerFactory
 */
class SnippetsListenerFactory extends AbstractFactory
{
    /**
     * Create a view snippets listener
     *
     * @return ViewTemplates
     */
    protected function create()
    {
        /** @var ViewTemplates $templates */
        $templates = $this->getServices()->get(ViewTemplates::class);
        return new SnippetsListener($templates);
    }
}
