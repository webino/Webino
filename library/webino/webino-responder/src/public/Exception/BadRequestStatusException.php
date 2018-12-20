<?php

namespace Webino;

use Webino\HttpStatus\BadRequest;

/**
 * Class BadRequestStatusException
 * @package webino-responder
 */
class BadRequestStatusException extends RuntimeException implements
    HttpStatusExceptionInterface
{
    use HttpStatusExceptionTrait;

    /**
     * @return HttpStatusInterface
     */
    protected function createHttpStatus(): HttpStatusInterface
    {
        return new BadRequest;
    }
}
