<?php

namespace WebinoEventLib\Exception;

use WebinoExceptionLib\ExceptionFormatTrait;
use Zend\EventManager\Exception\InvalidArgumentException as BaseInvalidArgumentException;

/**
 * Class InvalidArgumentException
 */
class InvalidArgumentException extends BaseInvalidArgumentException implements
    ExceptionInterface
{
    use ExceptionFormatTrait;
}
