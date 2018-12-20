<?php

namespace Webino;

/**
 * Class BlogRoute
 */
class BlogRoute extends DefaultRoute
{
    const PATH = 'blog';

    const VIEW = [
        ContentView::FILE => 'html://content/blog',
    ] + parent::VIEW;
}
