<?php

namespace Webino\Exception;

use Webino\HttpStatus\MethodNotAllowed;
use Webino\HttpStatusInterface;

/**
 * Class MethodNotAllowedStatusException
 */
class MethodNotAllowedStatusException extends RuntimeException implements
    HttpStatusExceptionInterface
{
    use HttpStatusExceptionTrait;

    /**
     * @return HttpStatusInterface
     */
    protected function createHttpStatus(): HttpStatusInterface
    {
        return new MethodNotAllowed;
    }
}
