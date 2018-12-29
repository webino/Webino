<?php

namespace Webino;

/**
 * Class BlogRoute
 */
class BlogRoute extends DefaultRoute
{
    const PATH = 'blog';

    //const PATH = 'blog/{article_id}';

    //const DEFAULTS = ['article_id' => 1];

    //const RULES = ['article_id' => '[0-9]+'];

    //const METHOD = 'GET';

    //const SCHEME = 'HTTP';

    //const HOST = 'webino.linux';

    //const OPTIONS = [];

    const VIEW = [
        ContentView::FILE => 'html://content/blog',
    ];
}
