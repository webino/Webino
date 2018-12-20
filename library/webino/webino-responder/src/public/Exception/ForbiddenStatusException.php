<?php

namespace Webino;

use Webino\HttpStatus\Forbidden;

/**
 * Class ForbiddenStatusException
 * @package webino-responder
 */
class ForbiddenStatusException extends RuntimeException implements
    HttpStatusExceptionInterface
{
    use HttpStatusExceptionTrait;

    /**
     * @return HttpStatusInterface
     */
    protected function createHttpStatus(): HttpStatusInterface
    {
        return new Forbidden;
    }
}
