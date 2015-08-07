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

*TODO...*

.. code-block:: php

    $app->debug();


$app->debug()->dump()
---------------------

*TODO...*

.. code-block:: php

    $app->debug()->dump();


$app->debug()->barDump()
------------------------

*TODO...*

.. code-block:: php

    $app->debug()->barDump();


$app->debug()->timer()
----------------------

*TODO...*

.. code-block:: php

    $app->debug()->timer();


Debugger Config
^^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:

.. include:: /guide/config/debugging.rst.inc


.. include:: /guide/cookbook/debugging.rst.inc
