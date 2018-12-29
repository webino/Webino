<?php

namespace Webino;

/**
 * Class E404Route
 * @package webino-system
 */
class E404Route extends DefaultRoute
{
    const PATH = 'E404';

    const VIEW = [
        ContentView::FILE => 'html://content/E404',
    ] + parent::VIEW;
}
