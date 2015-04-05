=======================
Application Logging API
=======================

Logs are important for monitoring the security of your application and to track events if problems occur,
as well as for auditing the correct usage of the system. The PSR-Logger interface standard is supported.

|vspace|

.. rst-class:: monospace

**$app->log(** *\\WebinoLogLib\\Log\\MessageInterface* **)**

*Writing a class message to a log.*

|vspace|

.. rst-class:: monospace

**$app->log(** *$level, ...$args* **)**

*Writing a string message to a log.*

----------------------
PSR-3-Logger Interface
----------------------

|vspace|

.. rst-class:: monospace

**$app->log()->emergency(** *$message, array $context = []* **)**

*Writing a warning message to a log.*

|vspace|

.. rst-class:: monospace

**$app->log()->alert(** *$message, array $context = []* **)**

*Writing an alert message to a log.*

|vspace|

.. rst-class:: monospace

**$app->log()->critical(** *$message, array $context = []* **)**

*Writing a critical message to a log.*

|vspace|

.. rst-class:: monospace

**$app->log()->error(** *$message, array $context = []* **)**

*Writing an error message to a log.*

|vspace|

.. rst-class:: monospace

**$app->log()->warning(** *$message, array $context = []* **)**

*Writing a warning message to a log.*

|vspace|

.. rst-class:: monospace

**$app->log()->notice(** *$message, array $context = []* **)**

*Writing a notice message to a log.*

|vspace|

.. rst-class:: monospace

**$app->log()->info(** *$message, array $context = []* **)**

*Writing an info message to a log.*

|vspace|

.. rst-class:: monospace

**$app->log()->debug(** *$message, array $context = []* **)**

*Writing a debug message to a log.*

|vspace|
