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
    public function __construct($view, HtmlNodeInterface $node)
    {
        $this->view = $view;
        $this->node = $node;
    }

    /**
     * @return object
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @return HtmlNodeInterface
     */
    public function getNode(): HtmlNodeInterface
    {
        return $this->node;
    }

    /**
     * @return HttpDispatchEvent|null
     */
    public function getDispatchEvent(): ?HttpDispatchEvent
    {
        return $this->dispatchEvent;
    }

    /**
     * @param HttpDispatchEvent|null $dispatchEvent
     */
    public function setDispatchEvent(?HttpDispatchEvent $dispatchEvent): void
    {
        $this->dispatchEvent = $dispatchEvent;
    }
}
