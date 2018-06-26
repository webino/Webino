<?php

namespace Webino\Exception;

/**
 * Class UnexpectedValueException
 */
class UnexpectedValueException extends \UnexpectedValueException implements ExceptionInterface
{
    use ExceptionFormatTrait;
}
