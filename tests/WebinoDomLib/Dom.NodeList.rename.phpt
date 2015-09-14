<?php

use Tester\Assert;

use WebinoDomLib\Dom;

require __DIR__ . '/../bootstrap.php';


$expected = '<!DOCTYPE html>
<html><head></head><body><p attr="value">Example body text.</p></body></html>
';


$code = '<!DOCTYPE html><html><head></head><body><span attr="value">Example body text.</span></body></html>';

$doc = new Dom($code);

$doc->locate('span')->rename('p');


Assert::same($expected, (string) $doc);
