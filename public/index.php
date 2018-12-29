<?php

namespace Webino;

require __DIR__ . '/../vendor/autoload.php';
chdir(__DIR__);
SystemApp::make()->dispatch();
