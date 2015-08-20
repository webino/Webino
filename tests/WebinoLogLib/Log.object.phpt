<?php

use Tester\Assert;
use WebinoConfigLib\Log\Writer\Mock;
use WebinoLogLib\Factory;

require __DIR__ . '/../bootstrap.php';


class TestDebugMessage
{
    public function __toString()
    {
        return 'Test debug message with extra values {0} {1}';
    }
}

class TestInfoMessage
{
    public function __toString()
    {
        return 'Test info message with extra values {0} {1}';
    }
}

class TestNoticeMessage
{
    public function __toString()
    {
        return 'Test notice message with extra values {0} {1}';
    }
}


class TestWarnMessage
{
    public function __toString()
    {
        return 'Test warning message with extra values {0} {1}';
    }
}

class TestErrMessage
{
    public function __toString()
    {
        return 'Test error message with extra values {0} {1}';
    }
}

class TestCritMessage
{
    public function __toString()
    {
        return 'Test critical message with extra values {0} {1}';
    }
}

class TestAlertMessage
{
    public function __toString()
    {
        return 'Test alert message with extra values {0} {1}';
    }
}

class TestEmergMessage
{
    public function __toString()
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
$logger = $factory->create($options);


$paramOne = 'ParamOne';
$paramTwo = 'ParamTwo';


$logger->log()->debug(new TestDebugMessage, [$paramOne, $paramTwo]);

$logger->log()->info(new TestInfoMessage, [$paramOne, $paramTwo]);

$logger->log()->notice(new TestNoticeMessage, [$paramOne, $paramTwo]);

$logger->log()->warning(new TestWarnMessage, [$paramOne, $paramTwo]);

$logger->log()->error(new TestErrMessage, [$paramOne, $paramTwo]);

$logger->log()->critical(new TestCritMessage, [$paramOne, $paramTwo]);

$logger->log()->alert(new TestAlertMessage, [$paramOne, $paramTwo]);

$logger->log()->emergency(new TestEmergMessage, [$paramOne, $paramTwo]);


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
