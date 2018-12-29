<?php

namespace Webino;

/**
 * Class ContentView
 */
class ContentView
{
    /**
     * Content view file
     */
    const FILE = 'content-file';

    /**
     * Content view file default value
     */
    const FILE_DEFAULT = 'html://content/default';

    /**
     * @param HtmlLayoutEvent $event
     */
    function layout(HtmlLayoutEvent $event): void
    {
        $app = $event->getApp();
        $content = $app[ContentView::FILE] ?? $this::FILE_DEFAULT;

        $file = $event->getApp()->getFile($content);
        $html = $file->getContents();

        $node = $event->getNode();
        $node->replaceWithHtml($html);
    }
}
