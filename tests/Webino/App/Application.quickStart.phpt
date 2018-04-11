<?php

use Tester\Assert;
use Webino\App\Application;
use Webino\App\Application\ConfiguredApplication;

require __DIR__ . '/../../bootstrap.php';


Webino::application()->bootstrap()->dispatch();

// TODO assert
