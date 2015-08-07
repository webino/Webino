<?php

use Tester\Assert;

use WebinoDomLib\Dom;

require __DIR__ . '/../bootstrap.php';


$expected = '<!DOCTYPE html>
<html><head></head><body>Example body text.</body></html>
';


$code = '<!DOCTYPE html><html><head></head><body></body></html>';

$doc = new Dom($code);

$doc->locate('body')->setValue('Example body text.');


Assert::same($expected, $doc->save());
