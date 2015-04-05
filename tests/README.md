# How To Run Tests

Powered by [Nette Tester](http://tester.nette.org/en/)

**Important:** All tests must ends with a `.phpt` file extension.

To run tests, go to a root directory of this repository and run following
commands.

**All tests**

- `vendor/bin/tester tests/`

**Specific namespace** e.g. *WebinoAppLib*

- `vendor/bin/tester tests/WebinoAppLib/`

**Specific test** e.g. *Application.create.phpt*

- `vendor/bin/tester tests/WebinoAppLib/Application.create.phpt`
