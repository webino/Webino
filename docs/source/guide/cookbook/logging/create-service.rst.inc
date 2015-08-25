Create file in your package folder with the name of your service. For example ``Service\MyService.php``
with the following contents:

.. code-block:: php

    namespace MyPackage\Service;

    use WebinoLogLib\LoggerAwareInterface;
    use WebinoLogLib\LoggerAwareTrait;

    class MyService implements LoggerAwareInterface
    {
        use LoggerAwareTrait;

        public function doSomething()
        {
            $this->getLogger()->log(MyLogMessage::class);
        }
    }

