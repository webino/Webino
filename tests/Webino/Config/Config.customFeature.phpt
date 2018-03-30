<?php

use Tester\Assert;
use WebinoConfigLib\Config;
use WebinoConfigLib\Feature\AbstractFeature;

require __DIR__ . '/../bootstrap.php';


class MyFeature extends AbstractFeature
{
    public function __construct($argOne, $argTwo)
    {
        $this->mergeArray([
            'some_settings' => [
                'anything' => ['foo' => $argOne, 'bar' => $argTwo],
            ],
        ]);
    }
}


$config = new Config([

    new MyFeature('OPTION_ONE', 'OPTION_TWO'),

]);


Assert::equal([

    'some_settings' => [
        'anything' => ['foo' => 'OPTION_ONE', 'bar' => 'OPTION_TWO'],
    ],

], $config->toArray());
