<?php

use Tester\Assert;
use WebinoConfigLib\Log\Writer\Mock;
use WebinoLogLib\Factory;
use WebinoLogLib\Message;

require __DIR__ . '/../bootstrap.php';


class TestDebugMessage extends Message\AbstractDebugMessage
{
    public function getMessage(array $args)
    {
        return 'Test debug message with extra values {0} {1}';
    }
}

class TestInfoMessage extends Message\AbstractInfoMessage
{
    public function getMessage(array $args)
    {
        return 'Test info message with extra values {0} {1}';
    }
}

class TestNoticeMessage extends Message\AbstractNoticeMessage
{
    public function getMessage(array $args)
    {
        return 'Test notice message with extra values {0} {1}';
    }
}


class TestWarnMessage extends Message\AbstractWarningMessage
{
    public function getMessage(array $args)
    {
        return 'Test warning message with extra values {0} {1}';
    }
}

class TestErrMessage extends Message\AbstractErrorMessage
{
    public function getMessage(array $args)
    {
        return 'Test error message with extra values {0} {1}';
    }
}

class TestCritMessage extends Message\AbstractCriticalMessage
{
    public function getMessage(array $args)
    {
        return 'Test critical message with extra values {0} {1}';
    }
}

class TestAlertMessage extends Message\AbstractAlertMessage
{
    public function getMessage(array $args)
    {
        return 'Test alert message with extra values {0} {1}';
    }
}

class TestEmergMessage extends Message\AbstractEmergencyMessage
{
    public function getMessage(array $args)
    {
        return 'Test emergency message with extra values {0} {1}';
    }
}


$options = [
    'writers' => [
        'mock' => (new Mock)->toArray(),
    ],
];

$factory = new Factory;
$log = $factory->create($options);


$paramOne = 'ParamOne';
$paramTwo = 'ParamTwo';


$log->log(TestDebugMessage::class, [$paramOne, $paramTwo]);

$log->log(TestInfoMessage::class, [$paramOne, $paramTwo]);

$log->log(TestNoticeMessage::class, [$paramOne, $paramTwo]);

$log->log(TestWarnMessage::class, [$paramOne, $paramTwo]);

$log->log(TestErrMessage::class, [$paramOne, $paramTwo]);

$log->log(TestCritMessage::class, [$paramOne, $paramTwo]);

$log->log(TestAlertMessage::class, [$paramOne, $paramTwo]);

$log->log(TestEmergMessage::class, [$paramOne, $paramTwo]);


/** @var \Zend\Log\Writer\Mock $mockWriter */
$mockWriter = $factory->loggerEngine->getWriters()->top();

Assert::same('DEBUG', $mockWriter->events[0]['priorityName']);
Assert::same('Test debug message with extra values `ParamOne` `ParamTwo`', $mockWriter->events[0]['message']);

Assert::same('INFO', $mockWriter->events[1]['priorityName']);
Assert::same('Test info message with extra values `ParamOne` `ParamTwo`', $mockWriter->events[1]['message']);

Assert::same('NOTICE', $mockWriter->events[2]['priorityName']);
Assert::same('Test notice message with extra values `ParamOne` `ParamTwo`', $mockWriter->events[2]['message']);

Assert::same('WARN', $mockWriter->events[3]['priorityName']);
Assert::same('Test warning message with extra values `ParamOne` `ParamTwo`', $mockWriter->events[3]['message']);

Assert::same('ERR', $mockWriter->events[4]['priorityName']);
Assert::same('Test error message with extra values `ParamOne` `ParamTwo`', $mockWriter->events[4]['message']);

Assert::same('CRIT', $mockWriter->events[5]['priorityName']);
Assert::same('Test critical message with extra values `ParamOne` `ParamTwo`', $mockWriter->events[5]['message']);

Assert::same('ALERT', $mockWriter->events[6]['priorityName']);
Assert::same('Test alert message with extra values `ParamOne` `ParamTwo`', $mockWriter->events[6]['message']);

Assert::same('EMERG', $mockWriter->events[7]['priorityName']);
Assert::same('Test emergency message with extra values `ParamOne` `ParamTwo`', $mockWriter->events[7]['message']);
