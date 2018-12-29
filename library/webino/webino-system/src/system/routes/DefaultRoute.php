<?php

namespace Webino;

/**
 * Class DefaultRoute
 * @package webino-system
 */
class DefaultRoute
{
    const PATH = Router::ROOT;

    const VIEW = [
        LayoutView::FILE => LayoutView::FILE_DEFAULT,
        ContentView::FILE => ContentView::FILE_DEFAULT,
    ];
}
