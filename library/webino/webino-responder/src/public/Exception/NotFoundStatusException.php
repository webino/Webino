<?php

namespace Webino;

use Webino\HttpStatus\NotFound;

/**
 * Class NotFoundStatusException
 * @package webino-responder
 */
class NotFoundStatusException extends RuntimeException implements
    HttpStatusExceptionInterface
{
    use HttpStatusExceptionTrait;

    /**
     * @return HttpStatusInterface
     */
    protected function createHttpStatus(): HttpStatusInterface
    {
        return new NotFound;
    }
}
