======================
Command Line Interface
======================

.. contents::
    :depth: 1
    :local:


Besides the rich features for building web applications, Webino™ has also full featured support for console
applications.


Usage
=====

You execute a command line action running application index file:

.. code-block:: bash

    php index.php


That shows a list of all available commands.

.. seealso::
   `Console Example <http://demo.webino.org/console>`_


Help Command
============

Every command also includes a help screen which displays and describes the command's available arguments and options.
To view a help screen, simply precede the name of the command with ``help``:

.. code-block:: bash

    php index.php help <command>


Runtime Console
===============

The Webino™ application comes with a built in REPL (Read-Eval-Print Loop) that makes it easy to run PHP code in
an interactive console. You can start the interactive console using:

.. code-block:: bash

    php index.php console


.. note::
    Runtime developer console is powered by `PsySH <http://psysh.org/>`_.


Script Version
==============

You may also view the current version of your Webino™ installation using the ``version`` command:

.. code-block:: bash

    php index.php version


Custom Commands
===============

The best practice to define a console command is as a class. For example:

.. code-block:: php

    namespace MyPackage\Console;

    use WebinoAppLib\Console\AbstractConsoleCommand;
    use WebinoAppLib\Event\ConsoleEvent;

    class MyConsoleCommand extends AbstractConsoleCommand
    {
        public function configure(Console $console)
        {
            $console
                ->setRoute('my-command')
                ->setTitle('My command title');
                ->setDescription('My command description.');
        }

        public function handle(ConsoleEvent $event)
        {
            $event->getCli()->out('My custom command example!');
        }
    }


Add a custom console command into application configuration.

.. code-block:: php

    use MyPackage\Console\MyConsoleCommand;
    use WebinoAppLib\Feature\Config;

    new Config([
        new MyConsoleCommand,
    ]);


.. seealso::
   `Console Command Example <http://demo.webino.org/console-command>`_
