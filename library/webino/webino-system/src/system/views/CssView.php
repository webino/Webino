<?php

namespace Webino;

/**
 * Class CssView
 * @package webino-system
 */
class CssView extends View\AbstractCssLink
{
    /**
     * @param ViewEvent $event
     * @return mixed
     */
    function getLink(ViewEvent $event)
    {
        $basePath = $event->getRequest()->getBasePath();
        $node = $event->getNode();
        if (empty($node['file'])) {
            // TODO exception
        }

        $filePath = "css/{$node['file']}.css";

        $app = $event->getApp();
        $file = $app->getFile("public://$filePath");

        return ["{$basePath}/{$filePath}", $file->getIntegrity()];
    }
}
