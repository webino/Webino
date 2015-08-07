<?php
/**
 * Perform an action before application dispatch
 */

use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Event\DispatchEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\Route;

/** @var \WebinoAppLib\Application\AbstractConfiguredApplication $app */
$app;

// -----------------------------------------------
// --- Write Your Custom Code Bellow This Line ---
// -----------------------------------------------

//var_dump($app->getRouter());exit;

/** @var \Zend\Mvc\Router\Http\TreeRouteStack $router */
$router = $app->getRouter();


// added via config
//$app->route('default')->setRoute('/');
//dd($app->route(DefaultRoute::class));
//$app->route(DefaultRoute::class)->setLiteral('/');

// added runtime
$app->route('something')
    ->setSegment('/something[/:paramtest]')
    ->setDefaults(['paramtest' => 'defaultvalue']);

//dd();

//dd($app->url()->getBaseUrl());

//dd($app->getRouter()->getBaseUrl());
//dd($app->url(DefaultRoute::class));
//dd($app->url('something', ['paramtest' => '123456']));


$app->bind(RouteEvent::NO_MATCH, function (DispatchEvent $event) {
    $event->setResponseContent('404 NOT FOUND');
});

$app->bind(DefaultRoute::class, function (RouteEvent $event) use ($app) {

    $event->setResponseContent('<p>Default Route</p>');

    $event->setResponseContent($app->url('something')->html('Test link to something'));
});


//$app->bind('route.something', function () {
//    echo '<p>Default Something</p>';
//});

$app->bindRoute('something', function (RouteEvent $event) {

//    dd($event->getRequest()->getBaseUrl());

//    dd($event->getRouteParam('paramtest'));

    $event->setResponseContent('<p>Default Something X ' . $event->getRouteParam('paramtest') . '</p>');
}, AppEvent::FINISH);

$app->bindRoute('something', function (RouteEvent $event) use ($app) {
    $event->setResponseContent('<p>Default Something 2</p>');
    $event->setResponseContent($app->url(DefaultRoute::class)->html('Test link to home')->setTitle('Bla bla bla')->setClass('x'));

//    $app->ur

//    $event->setResponseContent(
//        sprintf('<a href="%s">Test link to home</a>', $app->url(DefaultRoute::class))
//    );
});


// TODO route lisetner

$app->bind(AppEvent::DISPATCH, function (DispatchEvent $event) use ($app) {

//    dd($event->getApp());
//    dd($event->getRequest());
//    dd($event->getResponse());
//    dd(get_class($event->getRequest()));
//    $event->setResponseContent('TOTO JE POKUS');

//    $stream = new \Zend\Http\Response\Stream;
//    $stream->setStream(fopen(__FILE__, 'r'));
//    $stream->setStreamName(__FILE__);
//    $stream->getHeaders()->addHeaderLine('Content-type', 'application/force-download');
//    $stream->setHeader('Content-type', 'application/force-download');
//    $stream->setContent('asdasd');

//    $event->setResponse($stream);

//    $event->setResponseStream(__FILE__)->setForceDownload();
//    $event->setResponseStream(__FILE__);
//    $event->setResponseStream($app->file()->readStream('dispatch.php'));
});

// TODO route parameters example

// TODO child route example

// TODO route chain example?

// TODO route middleware examples

// TODO 404 error throwing example

//var_dump($request);exit;
//var_dump($activeRoute);exit;

// TODO
//var_dump($router);

// ---- routing examples


//$app->route('example-route')
//    ->setPath('/example-route');
//
//$app->bind('route.example-route', function () {
//    die('MATCH EXAMPLE ROUTE');
//});


//class ExampleRoute extends AbstractRoute
//{
//    const EVENT = parent::PREFIX . 'example.route';
//}
//
//$app->route(ExampleRoute::class);
//
//$app->bind(ExampleRoute::EVENT, function () {
//    die('MATCH EXAMPLE ROUTE VIA CLASS');
//});

// --------

// Layout rendering concepts

// TODO
//$app->bind(DrawEvent::RENDER, function (DrawEvent $event) {
$app->bind('render.html', function (DispatchEvent $event) {

    /** @var \WebinoDomLib\Dom $html */
    $doc = $event->getParam('doc');
    $state = $event->getParam('state');
    // TODO event param
    $spec = $state->spec;



    // TODO remove examples
    $doc->locate('title')
        ->setValue('New Page Title');

    $doc->locate('.content')
        // TODO placeholder support
        ->setHtml($state->content);

    // TODO remove examples

//    $spec->set('test')->setLocator('a')->setValue('x');

//    $spec->set('test')->setValue('y');

//    $spec->set(
//        (new \WebinoDrawLib\Feature\TableDraw('test-table'))
//            ->setLocator('body')
//            ->setHtml('{$_innerHtml}{$_table}')
//    );

});

$app->bind(DefaultRoute::class, function () use ($app) {
    $app->bind('render.html', function (DispatchEvent $event) {

        /** @var \WebinoDomLib\Dom $doc */
        $doc = $event->getParam('doc');

        // TODO append value
        $doc->locate('title')->setValue('HOME');

//        $html = $event->getParam('html');
//        $node = $html->xpath->query('//title')->item(0);
//        $node->nodeValue = $node->nodeValue . ' HOME';
    });
});

// TODO HTML layout listener
$app->bind(AppEvent::DISPATCH, function (DispatchEvent $event) {

    $content = $event->getResponse()->getContent();

    // TODO
    // obtaining draw config
    $commonDraw = $event->getApp()->getConfig()['draw']['common'];

//        pd($commonDraw->toArray());

    // TODO create a state
    $spec = new \WebinoDomLib\State\Config($commonDraw->toArray());
    $state = (object) [];
    $state->spec = $spec;
    $state->content = $content;

    // TODO create a template
    $layout = '<!DOCTYPE html><html><head><title>Webino Prototype</title></head><body>
<div class="side-column" style="background: green;"><p>before</p></div>
<div class="content" style="background: #159;"></div>
</body></html>';


    $html = $event->getResponse()->getContent();
    $doc = new \WebinoDomLib\Dom($layout);

    // TODO render a template
    $app = $event->getApp();
    $event->setParam('doc', $doc);
    $event->setParam('state', $state);
    $app->emit('render.html', $event);

    // TODO renderer factory
    $renderer = new \WebinoDomLib\Dom\Renderer;
    $events = $renderer->getEventManager();

    // setting a value
    $events->attach('render', function ($event) {

        $node  = $event->getParam('node');
        $spec  = $event->getParam('spec');
        $value = $spec->getValue();

        empty($value) or $node->setValue($value);
    });

    // setting a value
    $events->attach('render', function ($event) {

        $node = $event->getParam('node');
        $spec = $event->getParam('spec');
        $html = $spec->getHtml();

        // todo replace placeholders
        $innerHtml = $node->getInnerHtml();
        $html = $innerHtml . $html;

        empty($html) or $node->setHtml($html);
    });

    // TODO components render listener
    // components
    $events->attach('render', function (\Zend\EventManager\Event $event) {
        /** @var \WebinoDomLib\State\Spec $spec */
        $spec = $event->getParam('spec');

        $options = $spec->getOptions();

        if (empty($options['component'])) {
            return;
        }

        $events = $event->getTarget()->getEventManager();

        if (class_exists($options['component'])) {
            $events->trigger($options['component'], $event);
        } else {
            $events->trigger('render.component.' . $options['component'], $event);
        }

    }, DispatchEvent::BEGIN * 9);

    // resolve components data
    $events->attach(\WebinoDrawLib\Feature\TableDraw::class, function ($event) {
        $spec = $event->getParam('spec');
        if (!$spec->hasOption('data')) {
            return;
        }

        $dataProvider = [
            'exampleData' => [
                ['name' => 'Test Customer 01', 'age' => 18, 'gender' => 'male'],
                ['name' => 'Test Customer 02', 'age' => 54, 'gender' => 'female'],
                ['name' => 'Test Customer 03', 'age' => 37, 'gender' => 'male'],
                ['name' => 'Test Customer 04', 'age' => 17, 'gender' => 'female'],
            ],
            'exampleData2' => [
                ['name' => 'XTest Customer 01', 'age' => 18, 'gender' => 'male'],
                ['name' => 'XTest Customer 02', 'age' => 54, 'gender' => 'female'],
                ['name' => 'XTest Customer 03', 'age' => 37, 'gender' => 'male'],
                ['name' => 'XTest Customer 04', 'age' => 17, 'gender' => 'female'],
            ],
        ];

        $event->setParam('data', $dataProvider[$spec->getOption('data')]);
    });

    // table component
    $events->attach(\WebinoDrawLib\Feature\TableDraw::class, function (\Zend\EventManager\Event $event) {

        /** @var \WebinoDomLib\Dom\Element $node */
        $node = $event->getParam('node');
        $spec = $event->getParam('spec');
        $html = $spec->getHtml();

        // todo replace placeholders
        $innerHtml = $node->getInnerHtml();
        $html = $innerHtml . $html;

        $data = $event->getParam('data', []);
        if (empty($data)) {
            // TODO nothing to loop
            return;
        }

        // TODO default table template
        $html = $node->getInnerHtml();
        $newHtml = '<table><thead><tr><th></th></tr></thead><tbody><tr><td></td></tr></tbody></table>';

        $doc = new \WebinoDomLib\Dom($newHtml);

        // todo configurable locators
        $table = $doc->locate('table');
        $table->locate('thead th')
              ->loop(array_keys(current($data)), function (\WebinoDomLib\Dom\NodeList $node, $data) {
                  // TODO emit event
                  $node->setValue($data);
              });

        $table->locate('tbody tr')
            ->loop($data, function (\WebinoDomLib\Dom\NodeList $node, $data) {

                $node->locate('td')
                    ->loop($data, function (\WebinoDomLib\Dom\NodeList $node, $data) {
                        // TODO emit event
                        $node->setValue($data);
                    });
            });

        // todo spec vars
        $html = strtr($spec->getHtml(), ['{$_innerHtml}' => $html, '{$_table}' => $table->show()]);
        $node->setHtml($html);
        $spec->setHtml(null);
    });

    $renderer->render($doc, new \WebinoDomLib\Dom\State($spec->toArray()));

    // TODO set rendered result as a response content

    // TODO ajax support
    $event->resetResponseContent($doc->save());

}, AppEvent::FINISH * 99);

// --------

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

//    echo $app->getConfig('responseText');

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
