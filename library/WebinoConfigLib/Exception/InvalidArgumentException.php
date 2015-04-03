<?php

namespace WebinoConfigLib\Exception;

use WebinoExceptionLib\ExceptionFormatTrait;

/**
 * Class InvalidArgumentException
 */
class InvalidArgumentException extends \InvalidArgumentException implements
    ExceptionInterface
{
    use ExceptionFormatTrait;
}
