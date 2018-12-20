<?php

namespace Webino;

/**
 * Class UnexpectedValueException
 * @package webino-exception
 */
class UnexpectedValueException extends \UnexpectedValueException implements ExceptionInterface
{
    use ExceptionFormatTrait;
}
