<?php

use Tester\Assert;
use WebinoAppLib\Feature\Config;
use WebinoAppLib\Feature\CoreListener;
use WebinoAppLib\Feature\CoreService;
use WebinoAppLib\Feature\Listener;
use WebinoAppLib\Feature\Service;
use WebinoConfigLib\Feature\AbstractFeature;

require __DIR__ . '/../bootstrap.php';


class ExampleFeatureOne extends AbstractFeature
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

class ExampleFeatureTwo extends AbstractFeature
{
    public function __construct($argOne)
    {
        $this->mergeArray([
            'foo_bar' => $argOne,
        ]);
    }
}

class MyInvokableService
{

}

class MyService
{

}

class MyServiceFactory
{

}

class MyInvokableListenerOne
{

}

class MyInvokableListenerTwo
{

}

class MyListenerOne
{

}

class MyListenerOneFactory
{

}

class MyListenerTwo
{

}

class MyListenerTwoFactory
{

}

class MyCoreInvokableService
{

}

class MyCoreInvokableListener
{

}

$config = new Config([

    new ExampleFeatureOne('OPTION_ONE', 'OPTION_TWO'),
    new ExampleFeatureTwo('DEFAULT_OPTION'),
    new ExampleFeatureTwo('DEFAULT_OPTION_OVERRIDDEN'),

    new Service(MyInvokableService::class),
    new Service(['MyInvokableAlias' => MyInvokableService::class]),

    new Service(MyService::class, MyServiceFactory::class),
    new Service('MyServiceAlias', MyServiceFactory::class),

    new Listener(MyInvokableListenerOne::class),
    new Listener(['MyInvokableListenerAlias' => MyInvokableListenerTwo::class]),
    new Listener(MyListenerOne::class, MyListenerOneFactory::class),
    new Listener(['MyListenerAlias' => MyListenerTwo::class], MyListenerTwoFactory::class),

    new CoreService(MyCoreInvokableService::class),
    new CoreListener(MyCoreInvokableListener::class),

]);


$expected = [
    'some_settings' => [
        'anything' => ['foo' => 'OPTION_ONE', 'bar' => 'OPTION_TWO'],
    ],
    'foo_bar' => 'DEFAULT_OPTION_OVERRIDDEN',

    'services' => [
        'invokables' => [
            'MyInvokableService' => 'MyInvokableService',
            'MyInvokableAlias'   => 'MyInvokableService',

            'MyInvokableListenerOne' => 'MyInvokableListenerOne',
            'MyInvokableListenerTwo' => 'MyInvokableListenerTwo',
        ],
        'factories' => [
            'MyService' => 'MyServiceFactory',
            'MyServiceAlias' => 'MyServiceFactory',

            'MyListenerOne' => 'MyListenerOneFactory',
            'MyListenerTwo' => 'MyListenerTwoFactory',
        ],
    ],

    'listeners' => [
        'MyInvokableListenerOne' => 'MyInvokableListenerOne',
        'MyInvokableListenerAlias' => 'MyInvokableListenerTwo',
        'MyListenerOne' => 'MyListenerOne',
        'MyListenerAlias' => 'MyListenerTwo',
    ],

    'core' => [
        'listeners' => [
            'MyCoreInvokableListener' => 'MyCoreInvokableListener',
        ],
        'services' => [
            'invokables' => [
                'MyCoreInvokableService' => 'MyCoreInvokableService',
                'MyCoreInvokableListener' => 'MyCoreInvokableListener',
            ],
        ],
    ],
];

Assert::equal($expected, $config->toArray());
