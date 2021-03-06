.. rst-class:: sub-monospace

=====================
Application Debugging
=====================

.. contents::
    :depth: 1
    :local:


- Powered by `Tracy <http://tracy.nette.org>`__


.. rst-class:: monospace-topic

Debugger Interface
^^^^^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:


$app->getDebugger()
-------------------

Accessing debugger service.

.. code-block:: php

    /** @var \WebinoAppLib\Service\DebuggerInterface $debugger */
    $debugger = $app->getDebugger();


- see: `Debugger Example <http://demo.webino.org/debugger>`__


$app->debug()
-------------

Dumping information about a variable in readable format.

.. code-block:: php

    $app->debug($var);


Returning output instead of printing it.

.. code-block:: php

    $output = $app->debug($var, true);


- see: `Debugger Dump Example <http://demo.webino.org/debugger-dump>`__


$app->debug()->barDump()
------------------------

Dumping information about a variable into Tracy debugger bar.

.. code-block:: php

    $app->debug()->barDump($var);


- see: `Debugger Bar Dump Example <http://demo.webino.org/debugger-bar-dump>`__


$app->debug()->timer()
----------------------

TODO...

.. code-block:: php

    $app->debug()->timer();


- see: `Debugger Timer Example <http://demo.webino.org/debugger-timer>`_


$app->debug()->setBarInfo()
---------------------------

Setting information into Tracy debugger bar System info panel.

.. code-block:: php

    $app->debug()->setBarInfo('Test Label 01', 'Test Value01');
    // or as array
    $app->debug()->setBarInfo(['Test Label 02' => 'Test Value02']);


- see: `Debugger Bar Info Example <http://demo.webino.org/debugger-info>`__


$app->debug()->setBarPanel()
----------------------------

Setting custom debugger panel into Tracy bar.

.. code-block:: php

    /** @var \WebinoAppLib\Debugger\Bar\AbstractPanel $panel */
    $app->debug()->setBarPanel($panel);
    // or with an optional name
    $app->debug()->setBarPanel($panel, 'myDebugBarPanel');


- see: `Debugger Bar Panel Example <http://demo.webino.org/debugger-panel>`__


Debugger Config
^^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:

.. include:: /guide/config/debugging.rst.inc

.. include:: /guide/cookbook/debugging.rst.inc
