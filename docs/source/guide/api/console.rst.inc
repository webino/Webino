.. _api-console-bind-console:

$app->bindConsole()
-------------------

Binding to console commands.

.. code-block:: php

    use WebinoAppLib\Event\ConsoleEvent;

    $app->bindConsole('my-command', function (ConsoleEvent $event) {
        // obtaining console service
        $cli = $event->getCli();

        // obtaining command parameters
        $event->getParam('myCommandArgument');

        // doing something...
    });

.. seealso::
   :ref:`Config Console <config-console>` ●
   `Console Bind Example <http://demo.webino.org/console-bind>`__


Console Event
-------------

.. contents::
    :depth: 1
    :local:


----------------
$event->getCli()
----------------

Obtaining the console service from the console event object.

.. code-block:: php

    use WebinoAppLib\Event\ConsoleEvent;

    $consoleEventHandler = function (ConsoleEvent $event) {
        $cli = $event->getCli();
    };

.. seealso::
   `Console Example <http://demo.webino.org/console>`__ ●
   `Console Command Example <http://demo.webino.org/console>`__


Fluent interface:

.. code-block:: php

    // Method chaining
    $cli->red('Red text!')->green('Green text!');

    // If you prefer, you can also simply chain
    // the color method and continue using out.
    $cli->blue()->out('Blue? Wow!');


------------------
$event->getParam()
------------------

*Accessing command arguments/options.*

.. code-block:: php

    /** @var \WebinoAppLib\Event\ConsoleEvent $event */
    $value = $event->getParam('myCommandArgument');


$cli->out()
-----------

Printing text to the terminal.

.. code-block:: php

    $cli->out('Console text!');


$cli->inline()
--------------

Printing text inline to the terminal, without ending line break.

.. code-block:: php

    $cli->inline('Inline console text!');


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


.. seealso::
   `Console Columns Example <http://demo.webino.org/console-columns>`__


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


.. seealso::
   `Console Table Example <http://demo.webino.org/console-table>`__ ●
   `Console Assoc Table Example <http://demo.webino.org/console-table-assoc>`__


$cli->json()
------------

Printing pretty-printed JSON to the terminal.

.. code-block:: php

    $cli->json([
        'name' => 'Gary',
        'age'  => 52,
        'job'  => 'Engineer',
    ]);


$cli->sp()
----------

Printing spaces to the terminal.

.. code-block:: php

    $cli->sp();

    // many at once
    $cli->sp(3);

    // method chaining
    $cli->sp()->out('I have moved right a space.');


$cli->br()
----------

Printing line breaks to the terminal.

.. code-block:: php

    $cli->br();

    // many at once
    $cli->br(3);

    // method chaining
    $cli->br()->out('I have moved down a line.');


$cli->tab()
-----------

Printing tabulators to the terminal.

.. code-block:: php

    $cli->tab();

    // many at once
    $cli->tab(3);

    // method chaining
    $cli->tab()->out('I am all sorts of indented.');


$cli->draw()
------------

Drawing some ASCII art.

.. code-block:: php

    $cli->draw('bender');


$cli->border()
--------------

Inserting borders to break up output. Outputs a dashed border by default.

.. code-block:: php

    $cli->border();

    // character(s) to be repeated
    $cli->border('*');

    // length of the border
    $cli->border('*', 50);


$cli->dump()
------------

Dumping variables out to the terminal.

.. code-block:: php

    $cli->dump([
        'This',
        'That',
        'Other Thing',
    ]);


$cli->flank()
-------------

Bringing a little more attention to text.

.. code-block:: php

    $cli->flank('Look at me. Now.');

    // specifying the flanking characters
    $cli->flank('Look at me. Now.', '!');

    // and how many flanking characters there should be
    $cli->flank('Look at me. Now.', '!', 5);


$cli->progress()
----------------

Adding progress bars to the terminal.

.. code-block:: php

    $progress = $cli->progress()->total(100);
    // or shorthand it and pass the total
    // right into the progress method
    $progress = $cli->progress(100);

    for ($i = 0; $i <= 100; $i++) {
        $progress->current($i);

        // simulate something happening
        usleep(rand(10000, 300000));
    }


You can also manually advance the bar.

.. code-block:: php

    $progress = $cli->progress(100);

    // do something..

    $progress->advance(); // adds 1 to the current progress

    // do something..

    $progress->advance(10); // adds 10 to the current progress

    // do something..

    $progress->advance(5, 'Still going.'); // adds 5, displays a label


Pass a label into the ``current`` method if you’d like a more descriptive indicator of where you are in the process.

.. code-block:: php

    $items = [
        'php',
        'javascript',
        'python',
        'ruby',
        'java',
    ];

    $progress = $cli->progress(count($items));

    foreach ($items as $key => $value) {
        $progress->current($key + 1, $value);

        // simulate something happening
        usleep(rand(10000, 300000));
    }


$cli->padding()
---------------

Padding out a string to a specified length, allowing for neatly organized data.

.. code-block:: php

    $padding = $cli->padding(20);
    // or specify the padding character(s)
    $padding = $cli->padding(20, '-');

    $padding->label('Eggs')->result('1.99€');
    $padding->label('Oatmeal')->result('4.99€');
    $padding->label('Bacon')->result('2.99€');


$cli->animation()
-----------------

Taking ASCII art and running basic animations on it in the terminal. Valid directions are ``left``, ``top``, ``right``
and ``bottom``.

.. code-block:: php

    // movement
    $cli->animation('bender')->enterFrom('left');
    $cli->animation('bender')->exitTo('left');

    // scrolling
    $cli->animation('bender')->scroll('left');


Altering the speed of the animation. The parameter should be an integer representing the percentage of the default
speed.

.. code-block:: php

    // animate twice as fast
    $cli->animation('bender')->speed(200)->scroll('left');


.. note::
    ``50`` would make it slower by half, whereas ``200`` would make it run at twice the speed.


You can create a directory of text files that represent each keyframe in an animation and just run it manually.

.. code-block:: php

    $cli->addArt('my/folder/custom-animation');
    $cli->animation('custom-animation')->run();


.. note::
    You can add custom ASCII art using the ``addArt`` method.


$cli->addArt()
--------------

Adding your own art by setting the directory in which it is located.

.. code-block:: bash

    my/
      folder/
        art/
          dog.txt
          cat.txt
          mug.txt


Let the console service know where it is via the full path.

.. code-block:: php

    $cli->addArt('my/folder/art');


Now you can use anything in that directory.

.. code-block:: php

    $cli->draw('dog');
    $cli->red()->draw('cat');
    $cli->red()->bold()->draw('mug');


You can style your art using tags:

.. code-block:: none

    <blue>     ( )</blue>
    <blue>      H</blue>
    <blue>      H</blue>
    <blue>     _H_</blue>
    <blue>  .-'-.-'-.</blue>
    <blue> /         \</blue>
    <blue>|           |</blue>
    <blue>|   .-------'._</blue>
    <blue>|  /<white>/  '.' '.</white> \</blue>
    <blue>|  \<white>\ <black><red>@   @</red></black> /</white> /</blue>
    <blue>|   '---------'</blue>
    <blue>|    _______|</blue>
    <blue>|  .'<black>-+-+-+</black>|</blue>
    <blue>|  '.<black>-+-+-+</black>|</blue>
    <blue>|    """""" |</blue>
    <blue>'-.__   __.-'</blue>
    <blue>     """</blue>



$cli->clear()
-------------

Clearing the terminal.

.. code-block:: php

    $cli->clear();


Colors
------

.. contents::
    :depth: 1
    :local:


.. seealso::
    `Console Formatting Example <http://demo.webino.org/console-formatting>`__

|vspace|

-------------
$cli->black()
-------------

Printing text in black color to the terminal.

.. code-block:: php

    $cli->black('Black text!');


-----------
$cli->red()
-----------

Printing text in red color to the terminal.

.. code-block:: php

    $cli->red('Red text!');


-------------
$cli->green()
-------------

Printing text in green color to the terminal.

.. code-block:: php

    $cli->green('Green text!');


--------------
$cli->yellow()
--------------

Printing text in yellow color to the terminal.

.. code-block:: php

    $cli->yellow('Yellow text!');


------------
$cli->blue()
------------

Printing text in blue color to the terminal.

.. code-block:: php

    $cli->blue('Blue text!');


---------------
$cli->magenta()
---------------

Printing text in magenta color to the terminal.

.. code-block:: php

    $cli->magenta('Magenta text!');


------------
$cli->cyan()
------------

Printing text in cyan color to the terminal.

.. code-block:: php

    $cli->cyan('Cyan text!');


-----------------
$cli->lightGray()
-----------------

Printing text in light gray color to the terminal.

.. code-block:: php

    $cli->lightGray('Light gray text!');


----------------
$cli->darkGray()
----------------

Printing text in dark gray color to the terminal.

.. code-block:: php

    $cli->darkGray('Dark gray text!');


----------------
$cli->lightRed()
----------------

Printing text in light red color to the terminal.

.. code-block:: php

    $cli->lightRed('Light red text!');


------------------
$cli->lightGreen()
------------------

Printing text in light green color to the terminal.

.. code-block:: php

    $cli->lightGreen('Light green text!');


-------------------
$cli->lightYellow()
-------------------

Printing text in light yellow color to the terminal.

.. code-block:: php

    $cli->lightYellow('Light yellow text!');


-----------------
$cli->lightBlue()
-----------------

Printing text in light blue color to the terminal.

.. code-block:: php

    $cli->lightBlue('Light blue text!');


--------------------
$cli->lightMagenta()
--------------------

Printing text in light magenta color to the terminal.

.. code-block:: php

    $cli->lightMagenta('Light magenta text!');


-----------------
$cli->lightCyan()
-----------------

Printing text in light cyan color to the terminal.

.. code-block:: php

    $cli->lightCyan('Light cyan text!');


-------------
$cli->white()
-------------

Printing text in white color to the terminal.

.. code-block:: php

    $cli->white('White text!');


Background Colors
-----------------

.. contents::
    :depth: 1
    :local:


.. seealso::
    `Console Formatting Example <http://demo.webino.org/console-formatting>`__

|vspace|

---------------
$cli->blackBg()
---------------

Printing text on black background color to the terminal.

.. code-block:: php

    $cli->blackBg('Text on black background!');


-------------
$cli->redBg()
-------------

Printing text on red background color to the terminal.

.. code-block:: php

    $cli->redBg('Text on red background!');


---------------
$cli->greenBg()
---------------

Printing text on green background color to the terminal.

.. code-block:: php

    $cli->greenBg('Text on green background!');


----------------
$cli->yellowBg()
----------------

Printing text on yellow background color to the terminal.

.. code-block:: php

    $cli->yellowBg('Text on yellow background!');


--------------
$cli->blueBg()
--------------

Printing text on blue background color to the terminal.

.. code-block:: php

    $cli->blueBg('Text on blue background!');


-----------------
$cli->magentaBg()
-----------------

Printing text on magenta background color to the terminal.

.. code-block:: php

    $cli->magentaBg('Text on magenta background!');


--------------
$cli->cyanBg()
--------------

Printing text on cyan background color to the terminal.

.. code-block:: php

    $cli->cyanBg('Text on cyan background!');


--------------
$cli->grayBg()
--------------

Printing text on light gray background color to the terminal.

.. code-block:: php

    $cli->grayBg('Text on light gray background!');


------------------
$cli->darkGrayBg()
------------------

Printing text on dark gray background color to the terminal.

.. code-block:: php

    $cli->darkGrayBg('Text on dark gray background!');


------------------
$cli->lightRedBg()
------------------

Printing text on light red background color to the terminal.

.. code-block:: php

    $cli->lightRedBg('Text on light red background!');


--------------------
$cli->lightGreenBg()
--------------------

Printing text on light green background color to the terminal.

.. code-block:: php

    $cli->lightGreenBg('Text on light green background!');


---------------------
$cli->lightYellowBg()
---------------------

Printing text on light yellow background color to the terminal.

.. code-block:: php

    $cli->lightYellowBg('Text on light yellow background!');


--------------
$cli->blueBg()
--------------

Printing text on light blue background color to the terminal.

.. code-block:: php

    $cli->blueBg('Text on light blue background!');


-----------------
$cli->magentaBg()
-----------------

Printing text on light magenta background color to the terminal.

.. code-block:: php

    $cli->magentaBg('Text on light magenta background!');


--------------
$cli->cyanBg()
--------------

Printing text on light cyan background color to the terminal.

.. code-block:: php

    $cli->cyanBg('Text on light cyan background!');


---------------
$cli->whiteBg()
---------------

Printing text on white background color to the terminal.

.. code-block:: php

    $cli->whiteBg('Text on white background!');


Text Style
----------

.. contents::
    :depth: 1
    :local:


.. seealso::
    `Console Formatting Example <http://demo.webino.org/console-formatting>`__

|vspace|

------------
$cli->bold()
------------

Printing bold text to the terminal.

.. code-block:: php

    $cli->bold('Bold text!');


-----------
$cli->dim()
-----------

Printing dim text to the terminal.

.. code-block:: php

    $cli->dim('Dim text!');


-----------------
$cli->underline()
-----------------

Printing underlined text to the terminal.

.. code-block:: php

    $cli->underline('Underlined text!');


--------------
$cli->invert()
--------------

Printing inverted colors text to the terminal.

.. code-block:: php

    $cli->invert('Inverted colors text!');


Style Commands
--------------

.. contents::
    :depth: 1
    :local:


.. seealso::
    `Console Formatting Example <http://demo.webino.org/console-formatting>`__

|vspace|

------------
$cli->info()
------------

Printing text in an info style to the terminal.

.. code-block:: php

    $cli->info('Info text style!');


---------------
$cli->comment()
---------------

Printing text in a comment style to the terminal.

.. code-block:: php

    $cli->comment('Comment text style!');


---------------
$cli->whisper()
---------------

Printing text in a whisper style to the terminal.

.. code-block:: php

    $cli->whisper('Whisper text style!');


-------------
$cli->shout()
-------------

Printing text in a shout style to the terminal.

.. code-block:: php

    $cli->shout('Shout text style!');


-------------
$cli->error()
-------------

Printing text in an error style to the terminal.

.. code-block:: php

    $cli->error('Error text style!');


User Input
----------

.. contents::
    :depth: 1
    :local:


-------------
$cli->input()
-------------

Getting text from a user.

.. code-block:: php

    // basic input
    $input  = $cli->input('How you doin?');
    $result = $input->prompt();

    // multi-line input
    $input  = $cli->input('>>>')->multiLine();
    $result = $input->prompt();


.. note::
    Multi-line input will wait for ``CTRL+D`` before returning.


.. seealso::
   `Console Input Example <http://demo.webino.org/console-input>`__ ●
   `Console Input Multi-Line Example <http://demo.webino.org/console-input-multi-line>`__


Specifying certain answers from the user you only want to accept (case insensitive).

.. code-block:: php

    $input  = $cli->input('How you doin?')->accept(['Fine', 'Ok']);
    $result = $input->prompt();

    // or showing expecting answers
    $input  = $cli->input('How you doin?')->accept(['Fine', 'Ok'], true);
    $result = $input->prompt();


.. note::
    User will be re-prompted until responds with an acceptable answer.


Expecting answers exactly as they are specified (case sensitive).

.. code-block:: php

    $input  = $cli->input('How you doin?')->accept(['Fine', 'Ok'])->strict();
    $result = $input->prompt();


.. note::
    Answering ``fine`` or ``ok`` will cause a re-prompt.


Passing a closure into the ``accept`` method.

.. code-block:: php

    $input = $cli->input('How you doin?');

    $input->accept(function($result) {
        return ('Fine' === $result);
    });

    $result = $input->prompt();


.. seealso::
   `Console Input Accept Example <http://demo.webino.org/console-input-accept>`__ ●
   `Console Input Accept Closure Example <http://demo.webino.org/console-input-accept-closure>`__


Specifying a default response for when the user simply presses ``enter`` without typing anything in.

.. code-block:: php

    $input  = $cli->input('How you doin?')->defaultTo('Great!');
    $result = $input->prompt();


.. seealso::
   `Console Input Default Example <http://demo.webino.org/console-input-default>`__


---------------
$cli->confirm()
---------------

Prompting the user for ``y`` or ``n`` (strict).

.. code-block:: php

    $input = $cli->confirm('Continue?');

    if ($input->confirmed()) {
        // do something...
    }


.. seealso::
   `Console Confirm Example <http://demo.webino.org/console-confirm>`__


----------------
$cli->password()
----------------

Hiding text the user is typing.

.. code-block:: php

    $input = $cli->password('Please enter password:');
    $pwd   = $input->prompt();


.. seealso::
   `Console Password Example <http://demo.webino.org/console-password>`__


------------------
$cli->checkboxes()
------------------

Presenting the user with a set of interactive options. The user can select multiple of them.

.. code-block:: php

    $options = ['Ice Cream', 'Mixtape', 'Teddy Bear', 'Pizza', 'Puppies'];
    // or as associative array
    $options = [
        'option1' => 'Ice Cream',
        'option2' => 'Mixtape',
        'option3' => 'Teddy Bear',
        'option4' => 'Pizza',
        'option5' => 'Puppies'
    ];

    $input  = $cli->checkboxes('Please send me all of the following:', $options);
    $result = $input->prompt();


You will get an array back with the checked options (an empty array in the case of no checked options). If you
provide an associative array as the options, an array of the selected keys will be provided as the result.

.. seealso::
   `Console Checkboxes Example <http://demo.webino.org/console-checkboxes>`__


-------------
$cli->radio()
-------------

Presenting the user with a set of interactive options. The user can only select one of them.

.. code-block:: php

    $options = ['Ice Cream', 'Mixtape', 'Teddy Bear', 'Pizza', 'Puppies'];
    // or as associative array
    $options = [
        'option1' => 'Ice Cream',
        'option2' => 'Mixtape',
        'option3' => 'Teddy Bear',
        'option4' => 'Pizza',
        'option5' => 'Puppies'
    ];

    $input  = $cli->radio('Please send me one of the following:', $options);
    $result = $input->prompt();


The result will be a string, not an array (the selected key in the case of an associative array).

.. seealso::
   `Console Radio Example <http://demo.webino.org/console-radio>`__
