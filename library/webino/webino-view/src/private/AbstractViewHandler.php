<?php

namespace Webino;

/**
 * Class AbstractViewHandler
 * @package webino-view
 */
abstract class AbstractViewHandler extends AbstractEventHandler
{
    /**
     * Processed views
     *
     * @var iterable
     */
    protected $views = [];

    /**
     * Views already dispatched
     *
     * @var iterable
     */
    protected $dispatched = [];

    /**
     * @return void
     */
    protected function initEvents(): void
    {
        $this->on(ViewLayoutEvent::class, 'onLayout');
        $this->on(ViewDispatchEvent::class, 'onDispatch');
        $this->on(ViewResponseEvent::class, 'onResponse');
    }

    /**
     * Returns views query Xpath
     *
     * @return string
     */
    abstract protected function getQueryXpath(): string;

    /**
     * Setup view for each node
     *
     * @param HtmlNode $node
     * @param InstanceContainerInterface $container
     */
    abstract protected function eachNode(HtmlNode $node, InstanceContainerInterface $container): void;

    /**
     * On view layout event
     *
     * @param ViewLayoutEvent $event
     * @return bool|null
     */
    function onLayout(ViewLayoutEvent $event)
    {
        $app = $event->getApp();
        $dom = $event->getDom();

        try {
            $nodes = $dom->query($this->getQueryXpath());
            if (!$nodes->getLength()) {
                return false;
            }

            $nodes->each(function (HtmlNode $node) use ($app) {
                $this->eachNode($node, $app);
            });

            $this->layout($event);

        } catch (\Throwable $exc) {
            throw new InternalServerErrorStatusException($exc->getMessage(), 0, $exc);
        }

        return null;
    }

    /**
     * On view dispatch event
     *
     * @param ViewDispatchEvent $event
     * @return bool|mixed|null
     */
    function onDispatch(ViewDispatchEvent $event)
    {
        $app = $event->getApp();
        $dom = $event->getDom();

        try {

            // dispatch layout view
            $response = $this->dispatch($event);
            if ($response) {
                return $response;
            }

            // reset view
            $this->views = [];
            $nodes = $dom->query($this->getQueryXpath());
            if (!$nodes->getLength()) {
                return false;
            }

            $nodes->each(function (HtmlNode $node) use ($app) {
                $this->eachNode($node, $app);
            });

            // dispatch view
            $response = $this->dispatch($event);
            if ($response) {
                return $response;
            }

        } catch (\Throwable $exc) {
            throw new InternalServerErrorStatusException('View dispatch failed', 0, $exc);
        }

        return null;
    }

    /**
     * On view response event
     *
     * @param ViewResponseEvent $event
     * @return null
     */
    function onResponse(ViewResponseEvent $event)
    {
        try {
            $this->view($event);
        } catch (\Throwable $exc) {
            throw new InternalServerErrorStatusException('View response failed', 0, $exc);
        }
        return null;
    }

    /**
     * Add view item
     *
     * @param string $class
     * @param ViewHandlerItem $item
     */
    protected function addViewItem(string $class, ViewHandlerItem $item): void
    {
        $this->views[$class][] = $item;
    }

    /**
     * View layout pass
     *
     * @param ViewLayoutEvent $event
     * @return void
     */
    protected function layout(ViewLayoutEvent $event): void
    {
        foreach ($this->views as $views) {
            /** @var ViewHandlerItem $item */
            foreach ($views as $item) {
                $view = $item->getView();
                if (method_exists($view, 'layout')) {
                    $layoutEvent = new HtmlLayoutEvent($event);
                    $layoutEvent->setNode($item->getNode());
                    $view->layout($layoutEvent);
                }
            }
        }
    }

    /**
     * View dispatch pass
     *
     * @param ViewDispatchEvent $event
     * @return mixed
     */
    protected function dispatch(ViewDispatchEvent $event)
    {
        foreach ($this->views as $class => $views) {
            /** @var ViewHandlerItem $item */
            foreach ($views as $item) {
                $view = $item->getView();
                if (method_exists($view, 'dispatch')) {
                    if (isset($this->dispatched[$class])) {
                        continue;
                    }
                    $this->dispatched[$class] = true;

                    $dispatchEvent = new HttpDispatchEvent($event);
                    $response = $view->dispatch($dispatchEvent);

                    if ($response) {
                        return $response;
                    }
                }
                break;
            }
        }

        return null;
    }

    /**
     * View render pass
     *
     * @param ViewResponseEvent $event
     */
    protected function view(ViewResponseEvent $event): void
    {
        foreach ($this->views as $views) {
            /** @var ViewHandlerItem $item */
            foreach ($views as $item) {
                $view = $item->getView();
                if (method_exists($view, 'view')) {
                    $viewEvent = new ViewEvent($event);
                    $viewEvent->setNode($item->getNode());
                    $view->view($viewEvent);
                }
            }
        }
    }
}
