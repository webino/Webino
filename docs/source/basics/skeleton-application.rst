===========================
Webino Skeleton Application
===========================

.. contents::
    :depth: 1
    :local:

For standard applications it's best to use the Webino™ Skeleton Application.

|vspace|

.. note::
    See ``examples/skeleton-application/`` directory.


Directory Structure
===================

- ``<application-name>/`` *The application root directory.*

  - ``config/`` *Configuration files directory.*

    - ``autoload/`` *Autoloaded configuration files directory. VCS ignore local configs.*

      - ``local.php.dist`` *Predefined local config, handy for a package development.*

  - ``data/`` *Data files directory, archives.*

    - ``cache/`` *Cached files directory.*

    - ``export/`` *Exported files directory.*

    - ``extra/`` *Extra files directory.*

    - ``import/`` *Imported files directory.*

    - ``log/`` *Logger files directory, requires scheduled rotate.*

    - ``private/`` *Private files directory, private uploaded files.*

    - ``release/`` *Release specific files directory.*

  - ``public/`` *Public files directory, web server root.*

    - ``index.php`` *Public entry point.*

    - ``pipe.php`` *Asynchronous entry point.*

    - ``robots.txt`` *Search engine crawler configuration file*

    - ``assets/`` *Public assets directory.*

    - ``data/`` *Public data directory. PHP engine is off.*

      - ``tmp/`` *Public temporary data directory, public uploaded files.*

    - ``image/`` *Public images directory. PHP engine is off.*

      - ``tmp/`` *Public temporary images directory, public uploaded images.*

    - ``media/`` *Public media directory. PHP engine is off.*

    - ``resized/`` *Public resized images directory. PHP engine is off.*

  - ``tests/`` *Tests files directory.*

    - ``resources/`` *Tests resources directory.*

    - ``selenium/`` *Selenium tests directory.*

    - ``tester/`` *Nette Tester tests directory.*

  - ``tmp/`` *Temporary files directory, requires scheduled cleanup.*

    - ``cache/`` *Temporary cached files directory, session specific cache.*

      - ``common/`` *Common temporary cached files directory.*

    - ``common/`` *Common temporary files directory.*

    - ``data/`` *Private temporary data directory, private uploaded files.*

    - ``exported/`` *Temporary exported files directory.*

    - ``mail/`` *Temporary mail inbox.*

    - ``resized/`` *Private resized images directory.*

    - ``sessions/`` *Sessions directory.*


Dispatch Lock [**TODO**]
========================

It is possible to lock / unlock the application from a server dispatch. That means after locking application dispatch
it will wait to unlock for continue to finish the request.

.. code-block:: php

  $app->get(DispatchLock::class)->lock();

  $app->get(DispatchLock::class)->unlock();
