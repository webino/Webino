<?php

namespace WebinoViewLib\Listener;

use WebinoDomLib\Dom\Element;
use WebinoDomLib\Event\RenderEvent;
use WebinoEventLib\AbstractListener;
use WebinoViewLib\ViewTemplates;

/**
 * Class SnippetsListener
 */
class SnippetsListener extends AbstractListener
{
    /**
     * Option key
     */
    const SNIPPETS = 'snippets';

    /**
     * @var ViewTemplates
     */
    private $viewTemplates;

    /**
     * @param ViewTemplates $viewTemplates
     */
    public function __construct(ViewTemplates $viewTemplates)
    {
        $this->viewTemplates = $viewTemplates;
    }

    /**
     * Initialize listener
     */
    protected function init()
    {
        $this->listen(RenderEvent::class, 'handleSnippets', RenderEvent::BEFORE);
    }

    /**
     * @param RenderEvent $event
     */
    public function handleSnippets(RenderEvent $event)
    {
        $options = $event->getSpec()->getOptions();
        if (empty($options[$this::SNIPPETS])) {
            return;
        }

        $state = $event->getState();
        $state->setResolver(function ($property) use ($options, $state) {
            if (isset($options[$this::SNIPPETS][$property])) {
                return $this->viewTemplates->resolve($state->format($options[$this::SNIPPETS][$property]));
            }
        });
    }
}
