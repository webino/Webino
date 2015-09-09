===================
Application Context
===================

.. contents::
    :depth: 1
    :local:


The basic function of the application context is to bind listeners to the application when it really matters.
Basically, you define a condition that must be true to bind those context listeners.


Basic Context
=============

.. contents::
    :depth: 1
    :local:


Http
^^^^

TODO...

.. code-block::

    use WebinoAppLib\Feature\HttpListener;

    new Config([
        new HttpListener(MyHttpListener::class),
    ]);


Console
^^^^^^^

TODO...

.. code-block::

    use WebinoAppLib\Feature\ConsoleListener;

    new Config([
        new HttpListener(MyHttpListener::class),
    ]);


Context Listeners
=================

TODO...


Context Options
===============

TODO...


Custom Context
==============

Application context is a configuration, so it can have custom options.

Context is used to:


- configure a fallback (error) page
- configure language resolving
- configuring routes
- configuring other options
