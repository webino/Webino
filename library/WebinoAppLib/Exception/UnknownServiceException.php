<?php

namespace WebinoAppLib\Exception;

use WebinoExceptionLib\ExceptionFormatTrait;

/**
 * Class UnknownServiceException
 */
class UnknownServiceException extends \DomainException implements
    ExceptionInterface
{
    use ExceptionFormatTrait;
}
