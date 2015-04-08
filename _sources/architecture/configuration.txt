Application Configuration
=========================

.. contents::
    :depth: 1
    :local:

The configuration is an efficient way how to prepare your application for a dispatch. It may be cached,
and almost everything will be configured in a lazy style, on demand.

Configuration is basically a multidimensional array. Writing arrays in PHP is a little hell, because without
a documentation we doesn't know what to type, so configurators are introduced.

.. image:: ../_static/media/WebinoConfigLib_h400.png
    :class: centered


Configuration Features
----------------------

Configurators are used to generate an array configurations for large PHP applications. With them, you can generate
an array configuration in the OOP way. Everything is config and config can contain features. Feature is a fragment
of a pluggable configuration.

At first, create your new config feature:

.. code-block:: php

    use WebinoConfigLib\Feature\AbstractFeature;

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


then when you create a configuration like this:

.. code-block:: php

    use WebinoConfigLib\Config;

    return (new Config([

        new MyFeature('OPTION_ONE', 'OPTION_TWO'),

    ]))->toArray();


it will produce an array:

.. code-block:: php

    [
        'some_settings' => [
            'anything' => ['foo' => 'OPTION_ONE', 'bar' => 'OPTION_TWO'],
        ],
    ];


Application Configuration
-------------------------

Configuration features can be cascaded deeply if required, but plugged shallowly. That means we can add or remove
a feature from the config easily:

.. code-block:: php

    use WebinoAppLib\Feature\Config;

    new Config([

        new ExampleFeatureOne,
        new ExampleFeatureTwo('DEFAULT_OPTION'),

    ]);


adding another feature and changing the option:

.. code-block:: php

    use WebinoAppLib\Feature\Config;

    new Config([

        new ExampleFeatureOne,
        new ExampleFeatureTwo('MY_OPTION'),
        new ExampleFeatureThree,

    ]);


Calling a method on a configuration feature is easy:

.. code-block:: php

    use WebinoAppLib\Feature\Config;

    new Config([

        (new ExampleFeatureFoo('ANY_OPTION')
            ->setSomething('anything')),

    ]);


So we can produce a very complex configuration on a couple of lines.


Services Configuration
----------------------

With services configuration we can register invokables and factories to the application service manager.

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoAppLib\Feature\Service;

    return new Config([

        // registering an invokable
        new Service(MyInvokableService::class),

        // invokable with an alias
        new Service(['MyInvokableAlias' => MyInvokableService::class]),

        // registering a service factory
        new Service(MyService::class, MyServiceFactory::class),

        // service with an alias using factory
        new Service('MyServiceAlias', MyServiceFactory::class),

    ]);


Listeners Configuration
-----------------------

We can configure an application listeners bindings.

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoAppLib\Feature\Listener;

    return new Config([

        // registering an invokable listener
        new Listener(MyInvokableListener::class),

        // with an alias
        new Listener(['MyListenerAlias' => MyInvokableListener::class]),

        // registering a listener using factory
        new Listener(MyListener::class, MyListenerFactory::class),

        // a listener alias using factory
        new Listener(['MyListenerAlias' => MyListener::class], MyListenerFactory::class),

    ]);


Core Configuration
------------------

Services and listeners that should be available before an application is fully configured must be
registered into the core section of the configuration.

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoAppLib\Feature\CoreListener;
    use WebinoAppLib\Feature\CoreService;

    return new Config([

        // registering a core service
        new CoreService(MyInvokableService::class),

        // registering a core listener
        new CoreListener(MyInvokableListener::class),

    ]);

