<?php
/**
 * Webino Examples
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoHtmlLib\FieldsetHtml;
use WebinoHtmlLib\LineBreakHtml;
use WebinoHtmlLib\Title3Html;
use WebinoHtmlLib\TitleHtml;
use WebinoHtmlLib\UrlHtml;

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

    $content = '';
    foreach ($examples as $section => $items) {
        $content .= new Title3Html($section);
        foreach ($items as $item) {
            $content .= $item;
        }
    }

    $event->setResponseContent(new TitleHtml('Webino Examples'));
    $event->setResponseContent(new FieldsetHtml('API', $content));
    $event->setResponseContent(new FieldsetHtml('Cookbook', 'TODO...'));
    $event->setResponseContent(new FieldsetHtml('Applications', 'TODO...'));
});

$app->dispatch();
