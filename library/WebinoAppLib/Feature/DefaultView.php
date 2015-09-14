<?php

namespace WebinoAppLib\Feature;

use WebinoAppLib\Factory;
use WebinoAppLib\View\RouteLinkComponent;
use WebinoConfigLib\Feature\FeatureInterface;
use WebinoDomLib\Dom;
use WebinoViewLib\Component\AjaxFragmentComponent;
use WebinoViewLib\Component\ViewSnippetComponent;
use WebinoViewLib\Feature\CommonView;
use WebinoViewLib\Feature\ViewListener;
use WebinoViewLib\Listener\GeneralListener;
use WebinoViewLib\Listener\SnippetsListener;
use WebinoViewLib\ViewTemplates;

/**
 * Class DefaultView
 */
class DefaultView extends Config implements
    FeatureInterface
{
    /**
     * Application config key
     */
    const KEY = 'view';

    /**
     * Configure an application default router
     */
    public function __construct()
    {
        parent::__construct([
            new Service(ViewTemplates::class, Factory\View\ViewTemplatesFactory::class),
            new Service(Dom\Renderer::class, Factory\View\DomRendererFactory::class),
            new ViewListener(GeneralListener::class),
            new ViewListener(SnippetsListener::class, Factory\View\SnippetsListenerFactory::class),

            new CommonView([
                new RouteLinkComponent,
                new ViewSnippetComponent,
                new AjaxFragmentComponent,
            ]),
        ]);
    }
}
