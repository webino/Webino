<?php
/**
 * Logger Aware
 * Webino example
 */

use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Factory\AbstractFactory;
use WebinoAppLib\Feature\Service;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoHtmlLib\TextHtml;
use WebinoExamplesLib\Html\ScrollBoxHtml;
use WebinoConfigLib\Feature\Log;
use WebinoLogLib\LoggerAwareInterface;
use WebinoLogLib\LoggerAwareTrait;
use WebinoLogLib\Message\AbstractWarningMessage;
use Zend\Stdlib\Parameters;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Custom log message
 */
class MyLogMessage extends AbstractWarningMessage
{
    public function getMessage(Parameters $args)
    {
        return count($args) ? 'Test service warning log message {0} {1}!' : 'Test service warning log message!';
    }
}

/**
 * Custom logger aware
 */
class MyService implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    public function doSomething()
    {
        /**
         * Logging PSR-3
         * style.
         */
        $this->getLogger()->log()->debug('Test service debug log message!');

        /**
         * Logging PSR-3 style
         * with arguments.
         */
        $this->getLogger()->log()->debug('Test service debug log message {0} {1}!', ['paramOne', 'paramTwo']);
    }

    public function doSomethingDifferent()
    {
        /**
         * Logging message
         * class.
         */
        $this->getLogger()->log(MyLogMessage::class);

        /**
         * Logging message class
         * with arguments.
         */
        $this->getLogger()->log(MyLogMessage::class, ['paramOne', 'paramTwo']);
    }
}

/**
 * Custom service factory
 */
class MyServiceFactory extends AbstractFactory
{
    protected function create()
    {
        $myService = new MyService;

        /**
         * Injecting logger
         * into custom service.
         */
        $myService->setLogger($this->getApp()->getLogger());

        return $myService;
    }
}

$config = Webino::config([
    /**
     * Configuring app
     * log file.
     */
    new Log('app.log'),

    /**
     * Configuring custom
     * service factory.
     */
    new Service(MyService::class, MyServiceFactory::class),
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /** @var MyService $myService */
    $myService = $event->getApp()->get(MyService::class);

    /**
     * Calling custom
     * service methods.
     */
    $myService->doSomething();
    $myService->doSomethingDifferent();

    /**
     * Obtaining log
     * file contents.
     */
    $log = $event->getApp()->file()->read('app.log');

    $event->setResponseContent([
        'Application log:',
        new ScrollBoxHtml(nl2br(new TextHtml($log))),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
