<?php

namespace Webino;

/**
 * Class ViewHandlerItem
 * @package webino-view
 */
class ViewHandlerItem
{
    /**
     * @var object
     */
    private $view;

    /**
     * @var HtmlNodeInterface
     */
    private $node;

    /**
     * @var HttpDispatchEvent
     */
    private $dispatchEvent;

    /**
     * @param object $view
     * @param HtmlNodeInterface $node
     */
    function __construct($view, HtmlNodeInterface $node)
    {
        $this->view = $view;
        $this->node = $node;
    }

    /**
     * @return object
     */
    function getView()
    {
        return $this->view;
    }

    /**
     * @return HtmlNodeInterface
     */
    function getNode(): HtmlNodeInterface
    {
        return $this->node;
    }

    /**
     * @return HttpDispatchEvent|null
     */
    function getDispatchEvent(): ?HttpDispatchEvent
    {
        return $this->dispatchEvent;
    }

    /**
     * @param HttpDispatchEvent|null $dispatchEvent
     */
    function setDispatchEvent(?HttpDispatchEvent $dispatchEvent): void
    {
        $this->dispatchEvent = $dispatchEvent;
    }
}
