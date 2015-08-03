<?php
/**
 * Perform an action before application dispatch
 */

use WebinoAppLib\Event\AppEvent;

/** @var \WebinoAppLib\Application\AbstractConfiguredApplication $app */
$app;

// -----------------------------------------------
// --- Write Your Custom Code Bellow This Line ---
// -----------------------------------------------

class MyListener
{
    public function __invoke()
    {
        echo 'Ahoj!';
    }
}

//$app->bind(AppEvent::DISPATCH, MyListener::class, AppEvent::BEGIN);

$app->bind(AppEvent::DISPATCH, function () use ($app) {
    //    undefined();
    //    echo 'Svet';

    echo $app->getConfig('responseText');

}, AppEvent::BEGIN + 100);



//$app->log()->info('test log message');
//$app->log()->info('test log message z');
//$app->log()->info('test log message y');
//$app->log()->debug(new stdClass);



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
