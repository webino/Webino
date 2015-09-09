<?php

namespace WebinoAppLib\Exception;

use WebinoExceptionLib\ExceptionFormatTrait;

/**
 * Class OutOfBoundsException
 */
class OutOfBoundsException extends \OutOfBoundsException implements
    ExceptionInterface
{
    use ExceptionFormatTrait;
}
