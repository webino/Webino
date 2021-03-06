<?php

use Tester\Assert;
use WebinoConfigLib\Feature\MockLog;
use WebinoLogLib\Factory;

require __DIR__ . '/../bootstrap.php';


class TestDebugMessage
{
    public function __toString()
    {
        return 'Test debug message';
    }
}

class TestInfoMessage
{
    public function __toString()
    {
        return 'Test info message';
    }
}

class TestNoticeMessage
{
    public function __toString()
    {
        return 'Test notice message';
    }
}


class TestWarnMessage
{
    public function __toString()
    {
        return 'Test warning message';
    }
}

class TestErrMessage
{
    public function __toString()
    {
        return 'Test error message';
    }
}

class TestCritMessage
{
    public function __toString()
    {
        return 'Test critical message';
    }
}

class TestAlertMessage
{
    public function __toString()
    {
        return 'Test alert message';
    }
}

class TestEmergMessage
{
    public function __toString()
    {
        return 'Test emergency message';
    }
}


$factory = new Factory;
$logger  = $factory->create(current((new MockLog)->toArray()));


$logger->log()->debug(new TestDebugMessage);

$logger->log()->info(new TestInfoMessage);

$logger->log()->notice(new TestNoticeMessage);

$logger->log()->warning(new TestWarnMessage);

$logger->log()->error(new TestErrMessage);

$logger->log()->critical(new TestCritMessage);

$logger->log()->alert(new TestAlertMessage);

$logger->log()->emergency(new TestEmergMessage);


/** @var \Zend\Log\Writer\Mock $mockWriter */
$mockWriter = $factory->loggerEngine->getWriters()->top();

Assert::same('DEBUG', $mockWriter->events[0]['priorityName']);
Assert::same('Test debug message', $mockWriter->events[0]['message']);

Assert::same('INFO', $mockWriter->events[1]['priorityName']);
Assert::same('Test info message', $mockWriter->events[1]['message']);

Assert::same('NOTICE', $mockWriter->events[2]['priorityName']);
Assert::same('Test notice message', $mockWriter->events[2]['message']);

Assert::same('WARN', $mockWriter->events[3]['priorityName']);
Assert::same('Test warning message', $mockWriter->events[3]['message']);

Assert::same('ERR', $mockWriter->events[4]['priorityName']);
Assert::same('Test error message', $mockWriter->events[4]['message']);

Assert::same('CRIT', $mockWriter->events[5]['priorityName']);
Assert::same('Test critical message', $mockWriter->events[5]['message']);

Assert::same('ALERT', $mockWriter->events[6]['priorityName']);
Assert::same('Test alert message', $mockWriter->events[6]['message']);

Assert::same('EMERG', $mockWriter->events[7]['priorityName']);
Assert::same('Test emergency message', $mockWriter->events[7]['message']);
