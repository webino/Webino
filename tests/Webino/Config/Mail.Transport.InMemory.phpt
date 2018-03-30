<?php

use Tester\Assert;
use WebinoConfigLib\Mail\Transport;

require __DIR__ . '/../bootstrap.php';


$transport[] = new Transport\InMemory;


Assert::equal(['type' => 'inmemory'], $transport[0]->toArray());
