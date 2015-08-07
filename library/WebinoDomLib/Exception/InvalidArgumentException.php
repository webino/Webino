<?php

namespace WebinoDomLib\Exception;

use WebinoExceptionLib\ExceptionFormatTrait;

/**
 * Class InvalidArgumentException
 */
class InvalidArgumentException extends \Psr\Log\InvalidArgumentException implements
    ExceptionInterface
{
    use ExceptionFormatTrait;
}
