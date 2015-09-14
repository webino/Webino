<?php

namespace WebinoViewLib\Listener;

use WebinoDomLib\Dom\Element;
use WebinoDomLib\Event\RenderEvent;
use WebinoEventLib\AbstractListener;

/**
 * Class GeneralListener
 */
class GeneralListener extends AbstractListener
{
    /**
     * Initialize listener
     */
    protected function init()
    {
        $this->listen(RenderEvent::class, 'onInit', RenderEvent::BEFORE * 999);
        // TODO handleOnInit
        $this->listen(RenderEvent::class, 'handleReplace');
        $this->listen(RenderEvent::class, 'handleRename');
        $this->listen(RenderEvent::class, 'handleValue');
        $this->listen(RenderEvent::class, 'handleHtml');
        $this->listen(RenderEvent::class, 'handleAttribs');
        // TODO handleOnEnd
        $this->listen(RenderEvent::class, 'handleTrigger', RenderEvent::FINISH * 9);
    }

    /**
     * @param RenderEvent $event
     */
    public function onInit(RenderEvent $event)
    {
        $state = $event->getState();

        // resolve node properties
        $state->setResolver(function ($property) use ($event) {
            if ('_' !== $property[0]) {
                return;
            }

            $name = substr($property, 1);
            $node = $event->getNode();

            if ('nodeValue' === $name) {
                return $node->nodeValue;
            }

            if ('nodePath' === $name) {
                return $node->getNodePath();
            }

            if ('innerHtml' === $name) {
                return $node->getInnerHtml();
            }

            if ('outerHtml' === $name) {
                return $node->getOuterHtml();
            }

            if ($node->hasAttribute($name)) {
                return $node->getAttribute($name);
            }
        });

        // TODO refactor
        $spec = $event->getSpec();
        // TODO constants
        if (!$spec->hasOption('vars')) {
            return;
        }

        // TODO concept
        $specs = $spec->getOption('vars');

        $props = array_flip(array_combine(array_keys($specs), array_column($specs, 'prop')));

        // TODO concept

        // resolve custom properties
        $state->setResolver(function ($property) use ($specs, $props, $state) {
            if (!isset($props[$property])) {
                return;
            }

            $spec = $specs[$props[$property]];

            $args = array_map(function ($arg) use ($state) {
                return $state->format($arg);
            }, $spec['args']);

            return $spec['func']($state->format(...$args));
        });
    }

    /**
     * @param RenderEvent $event
     */
    public function handleReplace(RenderEvent $event)
    {
        $html = $event->getSpec()->getReplace();
        if (empty($html)) {
            return;
        }

        $node = $event->getNode()->replace($event->getState()->format($html));
        ($node instanceof Element) and $event->setNode($node);
    }

    /**
     * @param RenderEvent $event
     */
    public function handleRename(RenderEvent $event)
    {
        $newName = $event->getSpec()->getRename();
        if (empty($newName)) {
            return;
        }

        $node = $event->getNode()->rename($newName);
        $event->setNode($node);

        // TODO common
        $event->getParent()->setNode($node, $event->getSpec()->getKey());
    }

    /**
     * @param RenderEvent $event
     */
    public function handleValue(RenderEvent $event)
    {
        $value = $event->getSpec()->getValue();
        empty($value) or $event->getNode()->setValue($event->getState()->format($value));
    }

    /**
     * @param RenderEvent $event
     */
    public function handleHtml(RenderEvent $event)
    {
        $node = $event->getNode();
        $html = $event->getSpec()->getHtml();

        empty($html) or $node->setHtml($event->getState()->format($html));
    }

    /**
     * @param RenderEvent $event
     */
    public function handleAttribs(RenderEvent $event)
    {
        $attribs = $event->getSpec()->getAttribs();
        if (empty($attribs)) {
            return;
        }

        foreach ($attribs as $name => $value) {
            $event->getNode()->setAttribute($name, $event->getState()->format($value));
        }
    }

    /**
     * @param RenderEvent $event
     */
    public function handleTrigger(RenderEvent $event)
    {
        $options = $event->getSpec()->getOptions();
        // TODO constant?
        if (empty($options['trigger'])) {
            return;
        }

        $events = $event->getTarget()->getEvents();
        // TODO constant?
        foreach ((array) $options['trigger'] as $eventName) {
            if (class_exists($eventName)) {
                $events->trigger($eventName, $event);
            } else {
                // TODO name resolver
                $events->trigger('render.component.' . $eventName, $event);
            }
        }
    }
}
