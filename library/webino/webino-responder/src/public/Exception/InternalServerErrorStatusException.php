<?php

namespace Webino;

use Webino\HttpStatus\InternalServerError;

/**
 * Class InternalServerErrorStatusException
 * @package webino-responder
 */
class InternalServerErrorStatusException extends RuntimeException implements
    HttpStatusExceptionInterface
{
    use HttpStatusExceptionTrait;

    /**
     * @return HttpStatusInterface
     */
    protected function createHttpStatus(): HttpStatusInterface
    {
        return new InternalServerError;
    }
}
