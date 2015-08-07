<?php
/**
 * Webino examples
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoBaseLib\Html\LineBreakHtml;
use WebinoBaseLib\Html\Title3Html;
use WebinoBaseLib\Html\TitleHtml;
use WebinoBaseLib\Html\UrlHtml;

require __DIR__ . '/../vendor/autoload.php';

$app = Webino::application()->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {

    $examples = [];
    foreach ($event->getApp()->file()->listContents() as $info) {
        if ('dir' !== $info['type']) {
            continue;
        }

        list($section) = explode('-', $info['filename'], 2);
        $label = ucwords(str_replace('-', ' ', $info['filename']));
        $examples[ucfirst($section)][] = new UrlHtml($info['filename'], $label) . new LineBreakHtml;
    }

    $content = [];
    foreach ($examples as $section => $items) {
        $content[] = new Title3Html($section);
        foreach ($items as $item) {
            $content[] = $item;
        }
    }

    $event->setResponseContent(new TitleHtml('Webino Examples'));
    $event->setResponseContent($content);
});

$app->dispatch();
