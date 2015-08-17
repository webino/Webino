DebugBarInfo
------------

Configuring debugger bar info.

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoConfigLib\Feature\DebugBarInfo;

    new Config([
        new DebugBarInfo([
            'Custom Info 01' => 'Custom Info Value 01',
            'Custom Info 02' => 'Custom Info Value 02',
        ]),
    ]);


- see: `Debugger Bar Info Example <http://demo.webino.org/debugger-info-config>`_
  | :ref:`guide-cookbook-debugging-adding-debugger-bar-system-info`


DebugBarPanel
-------------

Configuring debugger bar panel.

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoAppLib\Feature\DebugBarPanel;

    new Config([
        // invokable
        new DebugBarPanel('myPanel', MyPanel::class),
        // service factory
        new DebugBarPanel('myPanel', MyPanel::class, MyPanelFactory::class),
    ]);


- see: `Debugger Bar Panel Example <http://demo.webino.org/debugger-panel-config>`_
  | :ref:`guide-cookbook-debugging-creating-debugger-bar-panel`
