<?php

namespace Webino;

/**
 * Class LinkView
 */
class LinkView
{
    /**
     * @param ViewEvent $event
     */
    function view(ViewEvent $event): void
    {
        $app = $event->getApp();
        $htmlNode = $event->getNode();

        $url = $htmlNode['url'];
        $text = $htmlNode['text'];
        $route = $htmlNode['route'];

        if ($route) {
            $router = $app->get(Router::class);
            $params = [];
            parse_str($htmlNode['params'], $params);
            $url = $router->url($route, $params);
        }

        $htmlNode->replaceWithHtml('<a/>');
        $htmlNode->setText($text);
        $htmlNode['href'] = $url;

        // TODO style
        $htmlNode['class'] = 'nav-link';
    }
}
