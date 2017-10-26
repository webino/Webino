<?php

namespace WebinoAppLib\Exception;

use WebinoExceptionLib\ExceptionFormatTrait;

/**
 * Class UnexpectedValueException
 */
class UnexpectedValueException extends \UnexpectedValueException implements
    ExceptionInterface
{
    use ExceptionFormatTrait;
}
