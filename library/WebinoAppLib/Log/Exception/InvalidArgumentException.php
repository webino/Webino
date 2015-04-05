<?php

namespace WebinoAppLib\Log\Exception;

use WebinoAppLib\Exception\ExceptionInterface;
use WebinoExceptionLib\ExceptionFormatTrait;

/**
 * Class InvalidArgumentException
 */
class InvalidArgumentException extends \Psr\Log\InvalidArgumentException implements
    ExceptionInterface
{
    use ExceptionFormatTrait;
}
