<?php

use Tester\Assert;

use WebinoDomLib\Dom;
use WebinoDomLib\Event\RenderEvent;

require __DIR__ . '/../bootstrap.php';


// TODO dom html tests

$expected = '<!DOCTYPE html>
<html><head></head><body>Hello Webino!</body></html>
';

$code = '<!DOCTYPE html><html><head></head><body></body></html>';

$doc = new Dom($code);

$cfg = new Dom\Config;

$renderer = new Dom\Renderer;


$cfg->set('test-body')->setLocator('body')->setValue('Hello Webino!');

// TODO
// $spec->set('test-spec.test-subspec.etc')->setPriority()->setLocator()->setValue();

$events = $renderer->getEvents();

// setting a value
$events->attach(RenderEvent::class, function (RenderEvent $event) {
    $node = $event->getNode();
    $spec = $event->getSpec();
    $node->setValue($spec->getValue());
});

$renderer->render($doc, $cfg);


Assert::same($expected, (string) $doc);

Assert::true(true);
