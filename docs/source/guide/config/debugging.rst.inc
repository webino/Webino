DebugBarInfo
------------

Configuring debugger bar info.

.. code-block:: php

    use WebinoConfigLib\Feature\DebugBarInfo;

    Webino::config([
        new DebugBarInfo([
            'Custom Info 01' => 'Custom Info Value 01',
            'Custom Info 02' => 'Custom Info Value 02',
        ]),
    ]);


.. seealso::
   `Debugger Bar Info Example <http://demo.webino.org/debugger-info-config>`__ ●
   :ref:`guide-cookbook-debugging-adding-debugger-bar-system-info`


DebugBarPanel
-------------

Configuring debugger bar panel.

.. code-block:: php

    use WebinoAppLib\Feature\DebugBarPanel;

    Webino::config([
        // invokable
        new DebugBarPanel('myPanel', MyPanel::class),
        // service factory
        new DebugBarPanel('myPanel', MyPanel::class, MyPanelFactory::class),
    ]);


.. seealso::
   `Debugger Bar Panel Example <http://demo.webino.org/debugger-panel-config>`__ ●
   :ref:`guide-cookbook-debugging-creating-debugger-bar-panel`
