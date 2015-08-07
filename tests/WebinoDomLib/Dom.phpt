<?php

use Tester\Assert;

use WebinoDomLib\Dom;

require __DIR__ . '/../bootstrap.php';

// TODO dom html tests

$expected = '<!DOCTYPE html>
<html><head><title>Test title</title></head><body title="Test title text" class="test class name"><span>Example content</span><div></div></body></html>
';


$code = '<!DOCTYPE html><html><head><title>Webino Prototype</title></head><body></body></html>';

$doc = new Dom($code);

$node[0] = $doc->locate('body');

$node[0]->setHtml('<span>Example content</span><div/>');


$doc->locate('title')->setHtml('Test title');

$doc->locate('body')->setAttributes([
    'title' => 'Test title text',
    'class' => 'test class name',
]);

$isEmpty[0] = $doc->locate('body span')->isEmpty();

$isEmpty[1] = $doc->locate('body div')->isEmpty();

$equal[0] = $doc->locate('body span')->getOuterHtml();

$equal[1] = $doc->locate('body')->getInnerHtml();

Assert::type(Dom\NodeList::class, $node[0]);

Assert::same($expected, $doc->save());

Assert::false($isEmpty[0]);

Assert::true($isEmpty[1]);

Assert::equal('<span>Example content</span>', $equal[0]);

Assert::equal('<span>Example content</span><div/>', $equal[1]);
