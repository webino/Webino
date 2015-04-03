<?php

namespace WebinoAppLib\Exception;

use WebinoExceptionLib\ExceptionFormatTrait;

/**
 * Class DomainException
 */
class DomainException extends \DomainException implements
    ExceptionInterface
{
    use ExceptionFormatTrait;
}
