======================
Command Line Interface
======================

.. contents::
    :depth: 1
    :local:


Webino™ has also full featured support for console applications.


Usage
=====

Executing command line actions running application index file.

.. code-block:: bash

    php index.php


.. seealso::
   That shows a list of all available commands ●
   `Console Example <http://demo.webino.org/console>`__


Help Command
============

Every command also includes a help screen which displays and describes the command's available arguments and options.
Simply precede the name of the command with ``help`` to view a help screen.

.. code-block:: bash

    php index.php help <command>


Interactive Console
===================

The Webino™ application comes with a built in REPL (Read-Eval-Print Loop) that makes it easy to run PHP code in
an interactive console. You can start the interactive console using:

.. code-block:: bash

    php index.php shell


Then you can interact with application objects like following:

.. container:: console-preview

    .. image:: ../_static/media/WebinoAppLib.console.runtime.gif

You have direct access to the ``$app`` and ``$cli`` objects.

.. container:: console-preview

    .. code-block:: bash

        # calling custom methods
        # on the application object
        >>> $app->file()->put('test.txt', 'Writing a test file from the runtime console.');

        # calling custom methods
        # on the console object
        >>> $cli->out('Test console message.');


.. note::
    Runtime developer console is powered by `PsySH <http://psysh.org/>`__.


Script Version
==============

You may also view the current version of your Webino™ installation using the ``version`` command.

.. code-block:: bash

    php index.php version


Custom Commands
===============

Creating custom console commands.

.. code-block:: php

    namespace MyPackage\Console;

    use WebinoAppLib\Console\AbstractConsoleCommand;
    use WebinoAppLib\Event\ConsoleEvent;

    class MyConsoleCommand extends AbstractConsoleCommand
    {
        public function configure(ConsoleRoute $route)
        {
            $route
                ->setPath('my-command')
                ->setTitle('My command title');
                ->setDescription('My command description.');
        }

        public function handle(ConsoleEvent $event)
        {
            $event->getCli()->out('My custom command example!');
        }
    }


Adding custom console command into application configuration.

.. code-block:: php

    use MyPackage\Console\MyConsoleCommand;

    Webino::config([
        new MyConsoleCommand,
    ]);


.. seealso::
   :ref:`Application Console Guide <guide-console>` ●
   `Console Command Example <http://demo.webino.org/console-command>`__ ●
   `Module Console Command Example <http://demo.webino.org/modules-console-command>`__
