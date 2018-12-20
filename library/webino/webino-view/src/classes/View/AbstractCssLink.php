<?php

namespace Webino\View;

use Webino\ViewEvent;

/**
 * Class AbstractCssLink
 * @package webino-view
 */
abstract class AbstractCssLink
{
    /**
     * Cross-origin
     */
    const CROSS_ORIGIN = 'anonymous';

    /**
     * Return CSS link URL
     *
     * @param ViewEvent $event
     * @return mixed
     */
    abstract function getLink(ViewEvent $event);

    /**
     * @param ViewEvent $event
     */
    function view(ViewEvent $event)
    {
        $node = $event->getNode();
        list($href, $integrity) = ((array) $this->getLink($event));

        $node->rename('link');
        $node['rel'] = 'stylesheet';
        $node['type'] = 'text/css';
        $node['crossorigin'] = $this::CROSS_ORIGIN;
        $node['integrity'] = $integrity;
        $node['href'] = $href;
    }
}
