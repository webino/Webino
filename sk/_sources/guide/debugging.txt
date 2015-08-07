.. rst-class:: sub-monospace

=====================
Application Debugging
=====================

.. contents::
    :depth: 1
    :local:


- Powered by `Tracy <http://tracy.nette.org>`_


.. rst-class:: monospace-topic

Debugging Methods
^^^^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:


$app->getDebugger()
-------------------

*Accessing debugger service.*

.. code-block:: php

    /** @var \WebinoAppLib\Service\DebuggerInterface $debugger */
    $debugger = $app->getDebugger();


$app->debug()
-------------

*Dumping information about a variable in readable format.*

.. code-block:: php

    $app->debug($var);


*Returning output instead of printing it.*

.. code-block:: php

    $output = $app->debug($var, true);


- see: `Debugger Dump Example <http://webino.local/dev/Webino/examples/simple/public/debugger-dump>`_


$app->debug()->barDump()
------------------------

*Dumping information about a variable into Tracy debugger bar.*

.. code-block:: php

    $app->debug()->barDump($var);


- see: `Debugger Bar Dump Example <http://webino.local/dev/Webino/examples/simple/public/debugger-bar-dump>`_


$app->debug()->timer()
----------------------

*TODO...*

.. code-block:: php

    $app->debug()->timer();


$app->debug()->setBarInfo()
---------------------------

*Setting information into Tracy debugger bar System info panel.*

.. code-block:: php

    $app->debug()->setBarInfo('Test Label 01', 'Test Value01');
    // or as array
    $app->debug()->setBarInfo(['Test Label 02' => 'Test Value02']);


$app->debug()->setBarPanel()
----------------------------

*Setting custom debugger panel into Tracy bar.*

.. code-block:: php

    /** @var \WebinoAppLib\Debugger\Bar\AbstractPanel $panel */
    $app->debug()->setBarPanel($panel);
    // or with name
    $app->debug()->setBarPanel($panel, 'myDebugBarPanel');


Debugger Config
^^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:

.. include:: /guide/config/debugging.rst.inc


.. include:: /guide/cookbook/debugging.rst.inc
