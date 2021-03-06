<?php

use org\bovigo\vfs\vfsStream;
use Psr\Log\LoggerInterface;
use Tester\Assert;
use WebinoAppLib\Application;
use WebinoConfigLib\Feature\Log;
use WebinoLogLib\Message\AbstractInfoMessage;
use WebinoLogLib\Message\AbstractWarningMessage;
use Zend\Stdlib\Parameters;

require __DIR__ . '/../bootstrap.php';

class MyLogMessageOne extends AbstractInfoMessage
{
    public function getMessage(Parameters $args)
    {
        return __CLASS__ . ' example...';
    }
}

class MyLogMessageTwo extends AbstractWarningMessage
{
    public function getMessage(Parameters $args)
    {
        return __CLASS__ . ' example...';
    }
}


createVfs([
    'data' => [
        'log' => [],
    ],
]);

$logFile = vfsStream::url('root/data/log/app.log');

$config = Webino::config([
    new Log($logFile),
]);

$app = Webino::application($config)->bootstrap();


$app->log(MyLogMessageOne::class);

$app->log(MyLogMessageTwo::class);

$app->log($app::DEBUG, 'Test log message example...');

$app->log()->emergency('An emergency log message example...');

$app->log()->debug(new stdClass);


$logData = file_get_contents($logFile);

Assert::type(LoggerInterface::class, $app->log());

Assert::contains('DEBUG (7): Test log message example...', $logData);

Assert::contains('INFO (6): MyLogMessageOne example...', $logData);

Assert::contains('WARN (4): MyLogMessageTwo example...', $logData);

Assert::contains('EMERG (0): An emergency log message example...', $logData);

Assert::contains('stdClass', $logData);
