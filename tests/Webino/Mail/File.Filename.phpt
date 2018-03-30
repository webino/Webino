<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

use Tester\Assert;
use Webino\Mail\File\Filename;

require __DIR__ . '/../../bootstrap.php';


$filename1 = Filename::create();
$filename2 = Filename::create();


Assert::match('~Mail_[0-9]+\.[0-9]+\.eml~', $filename1);
Assert::notEqual($filename1, $filename2);
