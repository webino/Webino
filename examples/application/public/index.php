<?php

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$app = (new \WebinoAppLib\Factory)->create()->bootstrap();

//$app->log()->info('test log message');
//$app->log()->info('test log message z');
//$app->log()->info('test log message y');
//$app->log()->debug(new stdClass);


$app->dispatch();










//use Webino\Application;
//use Webino\Event\AppEvent;
//use Webino\Markdown\Action\Result\Markdown;
//
//chdir(dirname(__DIR__));
//require 'vendor/autoload.php';
//
//$app = WebinoAppLib::application()->bootstrap();
////$app->dispatch();
//
//return;
//
//$app = Webino::application();
//
//$fc = function () {
//    return new Markdown('# Hello Webino!');
//};
//
//$app->bind(AppEvent::ACTION, $fc);
////$app->unbind($fc);
//
//$app = $app->bootstrap();
//
////$app->
//
//$app = $app->dispatch();