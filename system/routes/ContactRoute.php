<?php

namespace Webino;

/**
 * Class ContactRoute
 */
class ContactRoute extends DefaultRoute
{
    const PATH = 'contact';

    const VIEW = [
        ContentView::FILE => 'html://content/contact',
    ];
}
