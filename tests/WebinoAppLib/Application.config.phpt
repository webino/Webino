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
    /**
     * @param string $argOne
     * @param string $argTwo
     */
    public function __construct($argOne, $argTwo)
    {
        parent::__construct([
            [
                'some_settings' => [
                    'anything' => [
                        'foo' => (string) $argOne,
                        'bar' => (string) $argTwo,
                    ],
                ],
            ]
        ]);
    }
}

class ExampleFeatureTwo extends AbstractFeature
{
    /**
     * @param string $argOne
     */
    public function __construct($argOne)
    {
        parent::__construct([['foo_bar' => (string) $argOne]]);
    }

    /**
     * @param string $argOne
     * @return $this
     */
    public function setFooBaz($argOne)
    {
        $this->mergeArray(['foo_baz' => (string) $argOne]);
        return $this;
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

    (new ExampleFeatureTwo('DEFAULT_OPTION_OVERRIDDEN'))
        ->setFooBaz('CUSTOM_OPTION'),

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
    'foo_baz' => 'CUSTOM_OPTION',

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
                'MyCoreInvokableService'  => 'MyCoreInvokableService',
                'MyCoreInvokableListener' => 'MyCoreInvokableListener',
            ],
        ],
    ],
];

Assert::equal($expected, $config->toArray());
