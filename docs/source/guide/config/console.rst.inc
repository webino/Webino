.. _config-console:

Console
-------

Configuring console command routes.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\Route\Console;

    new CoreConfig([

        (new Console('my-basic-command'))
            ->setRoute('my-command')
            ->setTitle('My command title'),,

        (new Console('my-extra-command'))
            ->setRoute('my-command <requiredArgumentValue> --requiredOptionValue=')
            ->setTitle('My command title')
            ->setDescription([
                'My extra command',
                'multi-line description.',
            ])
            ->setArgumentsDescription([
                'requiredArgumentValue' => 'Enter custom argument value',
            ])
            ->setOptionsDescription([
                'requiredOptionValue=' => 'Enter custom option value',
            ]),
    ]);


.. seealso::
   :ref:`api-console-bind-console` ●
   `Console Bind Example <http://demo.webino.org/console-bind>`_ ●
   `Console Command Example <http://demo.webino.org/console-command>`_ ●
   `Module Console Command Example <http://demo.webino.org/modules-console-command>`_
