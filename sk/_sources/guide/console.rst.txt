.. _guide-console:

.. rst-class:: sub-monospace

===================
Application Console
===================

.. contents::
    :depth: 1
    :local:


This section provides an introduction into console service. Console tools are ideal for use in cron jobs,
or command line based utilities that don’t need to be accessible from a web browser.

- Powered by `CLImate <http://climate.thephpleague.com/>`__


Console Commands
^^^^^^^^^^^^^^^^

Console command is a class defining a route and an event handler.

.. code-block:: php

    use WebinoAppLib\Console\AbstractConsoleCommand;
    use WebinoAppLib\Event\ConsoleEvent;
    use WebinoConfigLib\Feature\Route\ConsoleRoute;

    class MyConsoleCommand extends AbstractConsoleCommand
    {
        public function configure(ConsoleRoute $route)
        {
            $route
                ->setPath('my-command')
                ->setTitle('My command title')
                ->setDescription('My command description.');
        }

        public function handle(ConsoleEvent $event)
        {
            // obtaining console service
            $cli = $event->getCli();

            // obtaining command parameters
            $event->getParam('myCommandArgument');

            // doing something...
            $cli->out('My console command example!');
        }
    }


Adding custom console command into application configuration.

.. code-block:: php

    Webino::config([
        new MyConsoleCommand,
    ]);


.. seealso::
   `Console Command Example <http://demo.webino.org/console-command>`__ ●
   `Module Console Command Example <http://demo.webino.org/modules-console-command>`__


Console Bind
------------

It is also possible to configure console command routes particularly.

.. code-block:: php

    use WebinoConfigLib\Feature\Route\ConsoleRoute;

    Webino::config([
        (new ConsoleRoute('my-command'))
            ->setPath('my-command')
            ->setTitle('My command title')
            ->setDescription('My command description.'),
    ]);


You can attach code to any console command execution.

.. code-block:: php

    use WebinoAppLib\Event\ConsoleEvent;

    $app->bindConsole('my-command', function (ConsoleEvent $event) {
        // obtaining console service
        $cli = $event->getCli();

        // obtaining command parameters
        $event->getParam('myCommandArgument');

        // doing something...
    });


Performing action on a default console command execution.

.. code-block:: php

    use WebinoAppLib\Console\ConsoleDefault;
    use WebinoAppLib\Event\ConsoleEvent;

    $app->bindConsole(ConsoleDefault::class, function (ConsoleEvent $event) {
        // do something...
    });


.. seealso::
   :ref:`api-console-bind-console` ●
   `Console Bind Example <http://demo.webino.org/console-bind>`__


Command Parameters
------------------

Obtaining command parameters.

.. code-block:: php

    /** @var \WebinoAppLib\Event\ConsoleEvent $event */
    $value = $event->getParam('myCommandArgument');


---------
Arguments
---------

Arguments are expected to appear on the command line exactly the way they are spelled in the route.

Providing required argument alternatives.

.. code-block:: php

    'my-command (requiredArgumentA|requiredArgumentB)'


Required and optional argument values.

.. code-block:: php

    'my-command <requiredArgumentValue> [<optionalArgumentValue>]'


Providing optional argument alternatives.

.. code-block:: php

    'my-command [optionalArgumentA|optionalArgumentB]'


-------
Options
-------

You can define any number of optional and required options. The order of options is ignored. They can be defined
in any order and the user can provide them in any other order.


Providing required option alternatives.

.. code-block:: php

    'my-command (--requiredOptionA|--requiredOptionB)'


Optional option and its short alternative.

.. code-block:: php

    'my-command [--optionalOption|-o]'


Options can digest text-based values.

.. code-block:: php

    'my-command --requiredOptionValue= [--optionalOptionValue=]'


|vspace|

.. seealso::
   `Console Command Example <http://demo.webino.org/console-command>`__ ●
   `Module Console Command Example <http://demo.webino.org/modules-console-command>`__


Console Config
^^^^^^^^^^^^^^

.. include:: /guide/config/console.rst.inc


.. _api-console:

Console Interface
^^^^^^^^^^^^^^^^^

.. contents::
    :depth: 2
    :local:


.. include:: /guide/api/console.rst.inc


Commands Schedule
^^^^^^^^^^^^^^^^^

TODO...


Advanced Styling
^^^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:


Combinations
------------

Chaining any of the style to get what you want.

.. code-block:: php

    $cli->blueBg()->green()->bold()->out('Fusce eget faucibus eros.');


You can apply more than one format to an output, but only one foreground and one background color.


Tags
----

Applying a foreground/background color and format with tags, to just part of an output.

.. code-block:: php

    $cli->blue('Please <light_red>remember</light_red> to <bold><yellow>restart</yellow></bold> the server.');


You can use any of the color or formatting keywords (snake cased) as tags.

Prepend the color with ``background_`` to use a background color tag.

.. code-block:: php

    $cli->blue('Please <background_light_red>remember</background_light_red> to restart the server.');


.. include:: /guide/cookbook/console.rst.inc
