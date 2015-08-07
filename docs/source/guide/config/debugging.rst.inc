DebugBarInfo
------------

*Adding debugger bar info.*

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoConfigLib\Feature\DebugBarInfo;

    new Config([

        new DebugBarInfo([
            'Custom Info 01' => 'Custom Info Value 01',
            'Custom Info 02' => 'Custom Info Value 02',
        ]),

    ]);


- see: :ref:`guide-cookbook-debugging-adding-debugger-bar-system-info`


DebugBarPanel
-------------

*Adding debugger bar panel.*

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\DebugBarPanel;

    new CoreConfig([

        // invokable
        new DebugBarPanel('myPanel', MyPanel::class),

        // service factory
        new DebugBarPanel('myPanel', MyPanel::class, MyPanelFactory::class),

    ]);


- see: :ref:`guide-cookbook-debugging-creating-debugger-bar-panel`
