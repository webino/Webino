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
    function view(ViewEvent $event): void
    {
        $node = $event->getNode();
        $link = (array) $this->getLink($event);

        if (empty($link[0])) {
            // TODO throw exception
        }

        $node->rename('link');
        $node['rel'] = 'stylesheet';
        $node['type'] = 'text/css';
        $node['crossorigin'] = $this::CROSS_ORIGIN;
        $node['href'] = $link[0];

        empty($link[1])
            or $node['integrity'] = $link[1];
    }
}
