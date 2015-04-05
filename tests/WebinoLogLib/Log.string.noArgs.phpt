<?php

use Tester\Assert;
use WebinoConfigLib\Log\Writer\Mock;
use WebinoLogLib\Factory;

require __DIR__ . '/../bootstrap.php';

$options = [
    'writers' => [
        'mock' => (new Mock)->toArray(),
    ],
];

$factory = new Factory;
$log = $factory->create($options);


$log->debug('Test debug message');

$log->info('Test info message');

$log->notice('Test notice message');

$log->warning('Test warning message');

$log->error('Test error message');

$log->critical('Test critical message');

$log->alert('Test alert message');

$log->emergency('Test emergency message');


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
