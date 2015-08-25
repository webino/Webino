.. rst-class:: sub-monospace

===================
Application Console
===================

.. contents::
    :depth: 1
    :local:


TODO...

- Powered by `CLImate <http://climate.thephpleague.com/>`_


.. _api-console:

Console Interface
^^^^^^^^^^^^^^^^^

.. contents::
    :depth: 2
    :local:


.. _api-console-bind-console:

$app->bindConsole()
-------------------

Binding to console commands.

.. code-block:: php

    use WebinoAppLib\Event\ConsoleEvent;
    use WebinoAppLib\Console\ConsoleDefault;

    $app->bindConsole(ConsoleDefault::class, function (ConsoleEvent $event) {
        $cli = $event->getCli();
        // do something...
    });

.. seealso::
   :ref:`Config Console <config-console>` ●
   `Console Example <http://demo.webino.org/console>`_


$event->getCli()
----------------

Obtaining the console service from the console event object.

.. code-block:: php

    use WebinoAppLib\Event\ConsoleEvent;

    $consoleEventHandler = function (ConsoleEvent $event) {
        $cli = $event->getCli();
    };


Fluent interface:

.. code-block:: php

    // Method chaining
    $cli->red('Red text!')->green('Green text!');

    // If you prefer, you can also simply chain
    // the color method and continue using out.
    $cli->blue()->out('Blue? Wow!');


Colors
------

.. contents::
    :depth: 1
    :local:


.. seealso::
    `Console Formatting Example <http://demo.webino.org/console-formatting>`_

|vspace|

-------------
$cli->black()
-------------

Printing console text in black color.

.. code-block:: php

    $cli->black('Black text!');


-----------
$cli->red()
-----------

Printing console text in red color.

.. code-block:: php

    $cli->red('Red text!');


-------------
$cli->green()
-------------

Printing console text in green color.

.. code-block:: php

    $cli->green('Green text!');


--------------
$cli->yellow()
--------------

Printing console text in yellow color.

.. code-block:: php

    $cli->yellow('Yellow text!');


------------
$cli->blue()
------------

Printing console text in blue color.

.. code-block:: php

    $cli->blue('Blue text!');


---------------
$cli->magenta()
---------------

Printing console text in magenta color.

.. code-block:: php

    $cli->magenta('Magenta text!');


------------
$cli->cyan()
------------

Printing console text in cyan color.

.. code-block:: php

    $cli->cyan('Cyan text!');


-----------------
$cli->lightGray()
-----------------

Printing console text in light gray color.

.. code-block:: php

    $cli->lightGray('Light gray text!');


----------------
$cli->darkGray()
----------------

Printing console text in dark gray color.

.. code-block:: php

    $cli->darkGray('Dark gray text!');


----------------
$cli->lightRed()
----------------

Printing console text in light red color.

.. code-block:: php

    $cli->lightRed('Light red text!');


------------------
$cli->lightGreen()
------------------

Printing console text in light green color.

.. code-block:: php

    $cli->lightGreen('Light green text!');


-------------------
$cli->lightYellow()
-------------------

Printing console text in light yellow color.

.. code-block:: php

    $cli->lightYellow('Light yellow text!');


-----------------
$cli->lightBlue()
-----------------

Printing console text in light blue color.

.. code-block:: php

    $cli->lightBlue('Light blue text!');


--------------------
$cli->lightMagenta()
--------------------

Printing console text in light magenta color.

.. code-block:: php

    $cli->lightMagenta('Light magenta text!');


-----------------
$cli->lightCyan()
-----------------

Printing console text in light cyan color.

.. code-block:: php

    $cli->lightCyan('Light cyan text!');


-------------
$cli->white()
-------------

Printing console text in white color.

.. code-block:: php

    $cli->white('White text!');


Background Colors
-----------------

.. contents::
    :depth: 1
    :local:


.. seealso::
    `Console Formatting Example <http://demo.webino.org/console-formatting>`_

|vspace|

-----------------------
$cli->backgroundBlack()
-----------------------

Printing console text on black background color.

.. code-block:: php

    $cli->backgroundBlack('Text on black background!');


---------------------
$cli->backgroundRed()
---------------------

Printing console text on red background color.

.. code-block:: php

    $cli->backgroundRed('Text on red background!');


-----------------------
$cli->backgroundGreen()
-----------------------

Printing console text on green background color.

.. code-block:: php

    $cli->backgroundGreen('Text on green background!');


------------------------
$cli->backgroundYellow()
------------------------

Printing console text on yellow background color.

.. code-block:: php

    $cli->backgroundYellow('Text on yellow background!');


----------------------
$cli->backgroundBlue()
----------------------

Printing console text on blue background color.

.. code-block:: php

    $cli->backgroundBlue('Text on blue background!');


-------------------------
$cli->backgroundMagenta()
-------------------------

Printing console text on magenta background color.

.. code-block:: php

    $cli->backgroundMagenta('Text on magenta background!');


----------------------
$cli->backgroundCyan()
----------------------

Printing console text on cyan background color.

.. code-block:: php

    $cli->backgroundCyan('Text on cyan background!');


---------------------------
$cli->backgroundLightGray()
---------------------------

Printing console text on light gray background color.

.. code-block:: php

    $cli->backgroundLightGray('Text on light gray background!');


--------------------------
$cli->backgroundDarkGray()
--------------------------

Printing console text on dark gray background color.

.. code-block:: php

    $cli->backgroundDarkGray('Text on dark gray background!');


--------------------------
$cli->backgroundLightRed()
--------------------------

Printing console text on light red background color.

.. code-block:: php

    $cli->backgroundLightRed('Text on light red background!');


----------------------------
$cli->backgroundLightGreen()
----------------------------

Printing console text on light green background color.

.. code-block:: php

    $cli->backgroundLightGreen('Text on light green background!');


-----------------------------
$cli->backgroundLightYellow()
-----------------------------

Printing console text on light yellow background color.

.. code-block:: php

    $cli->backgroundLightYellow('Text on light yellow background!');


---------------------------
$cli->backgroundLightBlue()
---------------------------

Printing console text on light blue background color.

.. code-block:: php

    $cli->backgroundLightBlue('Text on light blue background!');


------------------------------
$cli->backgroundLightMagenta()
------------------------------

Printing console text on light magenta background color.

.. code-block:: php

    $cli->backgroundLightMagenta('Text on light magenta background!');


---------------------------
$cli->backgroundLightCyan()
---------------------------

Printing console text on light cyan background color.

.. code-block:: php

    $cli->backgroundLightCyan('Text on light cyan background!');


-----------------------
$cli->backgroundWhite()
-----------------------

Printing console text on white background color.

.. code-block:: php

    $cli->backgroundWhite('Text on white background!');


Text Style
----------

.. contents::
    :depth: 1
    :local:


.. seealso::
    `Console Formatting Example <http://demo.webino.org/console-formatting>`_

|vspace|

------------
$cli->bold()
------------

Printing console bold text.

.. code-block:: php

    $cli->bold('Bold text!');


-----------
$cli->dim()
-----------

Printing console dim text.

.. code-block:: php

    $cli->dim('Dim text!');


-----------------
$cli->underline()
-----------------

Printing console underlined text.

.. code-block:: php

    $cli->underline('Underlined text!');


--------------
$cli->invert()
--------------

Printing console inverted text.

.. code-block:: php

    $cli->invert('Inverted text!');


Style Commands
--------------

.. contents::
    :depth: 1
    :local:


.. seealso::
    `Console Formatting Example <http://demo.webino.org/console-formatting>`_

|vspace|

------------
$cli->info()
------------

Printing console text in an info style.

.. code-block:: php

    $cli->info('Info text style!');


---------------
$cli->comment()
---------------

Printing console text in a comment style.

.. code-block:: php

    $cli->comment('Comment text style!');


---------------
$cli->whisper()
---------------

Printing console text in a whisper style.

.. code-block:: php

    $cli->whisper('Whisper text style!');


-------------
$cli->shout()
-------------

Printing console text in a shout style.

.. code-block:: php

    $cli->shout('Shout text style!');


-------------
$cli->error()
-------------

Printing console text in an error style.

.. code-block:: php

    $cli->error('Error text style!');


Functions
---------

.. contents::
    :depth: 1
    :local:


-----------
$cli->out()
-----------

Printing console text.

.. code-block:: php

    $cli->out('Console text!');


--------------
$cli->inline()
--------------

Printing console text inline, without ending line break.

.. code-block:: php

    $cli->inline('Inline console text!');


---------------
$cli->columns()
---------------

List out an array of data so that it is easily readable.

.. code-block:: php

    $data = [
        '12 Monkeys',
        '12 Years a Slave',
        'A River Runs Through It',
        'Across the Tracks',
        'Babel',
        'Being John Malkovich',
        'Burn After Reading',
        'By the Sea',
        'Confessions of a Dangerous Mind',
        'Contact',
        'Cool World',
        'Cutting Class',
        'Fight Club',
        'Fury',
        'Happy Feet Two',
        'Happy Together',
        'Hunk',
        'Inglourious Basterds',
        'Interview with the Vampire',
        'Johnny Suede',
        'Kalifornia',
        'Killing Them Softly',
        'Legends of the Fall',
        'Less Than Zero',
        'Meet Joe Black',
        'Megamind',
        'Moneyball',
    ];

    $cli->columns($data);


Specify the number of columns by passing in a second parameter.

.. code-block:: php

    $cli->columns($data, 4);


.. note::
    Console service will try to figure out how the content best fits in your terminal by default.


Specify the columns via an array of arrays.

.. code-block:: php

    $data = [
        ['Gary', 'Mary', 'Larry', 'Terry'],
        [1.2, 4.3, 0.1, 3.0],
        [6.6, 4.4, 5.5, 3.3],
        [9.1, 8.2, 7.3, 6.4],
    ];

    $cli->columns($data);


-------------
$cli->table()
-------------

Make table out of an array of data so that it is easily readable.

.. code-block:: php

    $data = [
        [
          'Walter White',
          'Father',
          'Teacher',
        ],
        [
          'Skyler White',
          'Mother',
          'Accountant',
        ],
        [
          'Walter White Jr.',
          'Son',
          'Student',
        ],
    ];

    $cli->table($data);


If you pass in an array of associative arrays or objects, the keys will automatically become the header of the table.

.. code-block:: php

    $data = [
        [
            'name'       => 'Walter White',
            'role'       => 'Father',
            'profession' => 'Teacher',
        ],
        [
            'name'       => 'Skyler White',
            'role'       => 'Mother',
            'profession' => 'Accountant',
        ],
        [
            'name'       => 'Walter White Jr.',
            'role'       => 'Son',
            'profession' => 'Student',
        ],
    ];

    $cli->table($data);


------------
$cli->json()
------------

TODO...


----------
$cli->br()
----------

TODO...


-----------
$cli->tab()
-----------

TODO...


------------
$cli->draw()
------------

TODO...


--------------
$cli->border()
--------------

TODO...


------------
$cli->dump()
------------

TODO...


-------------
$cli->flank()
-------------

TODO...


----------------
$cli->progress()
----------------

TODO...


---------------
$cli->padding()
---------------

TODO...


-------------
$cli->input()
-------------

TODO...


---------------
$cli->confirm()
---------------

TODO...


----------------
$cli->password()
----------------

TODO...


------------------
$cli->checkboxes()
------------------

TODO...


-------------
$cli->radio()
-------------

TODO...


-----------------
$cli->animation()
-----------------

TODO...


--------------
$cli->addArt()
--------------

TODO...


-------------
$cli->clear()
-------------

TODO...


Console Config
^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:

.. include:: /guide/config/console.rst.inc


.. _config-console-commands:

Console Commands
^^^^^^^^^^^^^^^^

A filter blocks a message from being written to the log.

.. contents::
    :depth: 1
    :local:


Commands Schedule
^^^^^^^^^^^^^^^^^

TODO...


.. include:: /guide/cookbook/console.rst.inc
