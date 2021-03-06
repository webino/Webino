<?php

use Tester\Assert;
use WebinoConfigLib\Feature\MockLog;
use WebinoLogLib\Factory;

require __DIR__ . '/../bootstrap.php';


$factory = new Factory;
$logger  = $factory->create(current((new MockLog)->toArray()));

$paramOne = 'ParamOne';
$paramTwo = 'ParamTwo';


$logger->log()->debug('Test debug message with extra values {0} {1}', [$paramOne, $paramTwo]);

$logger->log()->info('Test info message with extra values {0} {1}', [$paramOne, $paramTwo]);

$logger->log()->notice('Test notice message with extra values {0} {1}', [$paramOne, $paramTwo]);

$logger->log()->warning('Test warning message with extra values {0} {1}', [$paramOne, $paramTwo]);

$logger->log()->error('Test error message with extra values {0} {1}', [$paramOne, $paramTwo]);

$logger->log()->critical('Test critical message with extra values {0} {1}', [$paramOne, $paramTwo]);

$logger->log()->alert('Test alert message with extra values {0} {1}', [$paramOne, $paramTwo]);

$logger->log()->emergency('Test emergency message with extra values {0} {1}', [$paramOne, $paramTwo]);


/** @var \Zend\Log\Writer\Mock $mockWriter */
$mockWriter = $factory->loggerEngine->getWriters()->top();

Assert::same('DEBUG', $mockWriter->events[0]['priorityName']);
Assert::same('Test debug message with extra values ParamOne ParamTwo', $mockWriter->events[0]['message']);

Assert::same('INFO', $mockWriter->events[1]['priorityName']);
Assert::same('Test info message with extra values ParamOne ParamTwo', $mockWriter->events[1]['message']);

Assert::same('NOTICE', $mockWriter->events[2]['priorityName']);
Assert::same('Test notice message with extra values ParamOne ParamTwo', $mockWriter->events[2]['message']);

Assert::same('WARN', $mockWriter->events[3]['priorityName']);
Assert::same('Test warning message with extra values ParamOne ParamTwo', $mockWriter->events[3]['message']);

Assert::same('ERR', $mockWriter->events[4]['priorityName']);
Assert::same('Test error message with extra values ParamOne ParamTwo', $mockWriter->events[4]['message']);

Assert::same('CRIT', $mockWriter->events[5]['priorityName']);
Assert::same('Test critical message with extra values ParamOne ParamTwo', $mockWriter->events[5]['message']);

Assert::same('ALERT', $mockWriter->events[6]['priorityName']);
Assert::same('Test alert message with extra values ParamOne ParamTwo', $mockWriter->events[6]['message']);

Assert::same('EMERG', $mockWriter->events[7]['priorityName']);
Assert::same('Test emergency message with extra values ParamOne ParamTwo', $mockWriter->events[7]['message']);
