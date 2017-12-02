======================
Webino Skeleton Module
======================

.. contents::
    :depth: 1
    :local:

For new modules it's best to use the Webino™ Skeleton Module.

|vspace|

.. note::
    See ``examples/skeleton-module/`` directory.


Directory Structure
===================

- ``<module-name>/`` *The module root directory.*

  - ``Module.php`` *Module core class file.*

  - ``config/`` *Configuration files directory.*

  - ``data/`` *Data files directory, archives.*

  - ``doc/`` *Documentation files directory.*

    - ``media/`` *Media files directory.*

  - ``language/`` *Language files directory.*

  - ``public/`` *Public files directory, web server root.*

    - ``assets/`` *Public assets directory.*

  - ``src/`` *Source files directory.*

  - ``tests/`` *Tests files directory.*

    - ``resources/`` *Tests resources directory.*

    - ``selenium/`` *Selenium tests directory.*

    - ``tester/`` *Nette Tester tests directory.*

  - ``view/`` *Template files directory.*
