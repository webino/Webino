# WebinoExceptionLib - PHP`s Exceptions Boilerplate

The usage of exceptions is very important but the default PHP implementation
may lack some features, this is the place to fix it.


## QuickUse

Currently there is only one exceptions feature.

### ExceptionFormatTrait

This trait is used to add a `format()` method to exceptions to format their messages.

Format exception message like using a `sprintf()` function:

    throw (new SomeException('Expected %s not %s'))
        ->format(SomeInterface::class, $anyObject);
        
You have to add the `ExceptionFormatTrait` to your exception class:
    
    use WebinoExceptionLib\ExceptionFormatTrait;
    
    class SomeException extends \LogicException implements
        ExceptionInterface
    {
        use ExceptionFormatTrait;
    }

## Addendum

This library is a part of the Webino™ platform for web applications.
