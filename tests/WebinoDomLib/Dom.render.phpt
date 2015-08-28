<?php

use Tester\Assert;

use WebinoDomLib\Dom;

require __DIR__ . '/../bootstrap.php';


// TODO dom html tests

$expected = '<!DOCTYPE html>
<html><head></head><body>Hello Webino!</body></html>
';

$code = '<!DOCTYPE html><html><head></head><body></body></html>';

$doc = new Dom($code);

$renderer = new Dom\Renderer;

$cfg = new \WebinoDomLib\State\Config;

$cfg->set('test-body')->setLocator('body')->setValue('Hello Webino!');

// TODO
// $spec->set('test-spec.test-subspec.etc')->setPriority()->setLocator()->setValue();

$state = new Dom\State($cfg->toArray());

$events = $renderer->getEvents();

// setting a value
$events->attach('render', function ($event) {

    $node = $event->getParam('node');
    $spec = $event->getParam('spec');

    $node->setValue($spec->getValue());
});

$renderer->render($doc, $state);


Assert::same($expected, $doc->save());

Assert::true(true);
