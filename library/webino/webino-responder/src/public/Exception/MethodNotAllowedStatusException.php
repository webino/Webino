<?php

namespace Webino;

use Webino\HttpStatus\MethodNotAllowed;

/**
 * Class MethodNotAllowedStatusException
 * @package webino-responder
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
