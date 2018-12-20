<?php

namespace Webino;

use Webino\HttpStatus\NotAcceptable;

/**
 * Class NotAcceptableStatusException
 * @package webino-responder
 */
class NotAcceptableStatusException extends RuntimeException implements
    HttpStatusExceptionInterface
{
    use HttpStatusExceptionTrait;

    /**
     * @return HttpStatusInterface
     */
    protected function createHttpStatus(): HttpStatusInterface
    {
        return new NotAcceptable;
    }
}
