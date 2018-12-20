<?php

namespace Webino;

use Webino\HttpStatus\NotImplemented;

/**
 * Class NotImplementedStatusException
 * @package webino-responder
 */
class NotImplementedStatusException extends RuntimeException implements
    HttpStatusExceptionInterface
{
    use HttpStatusExceptionTrait;

    /**
     * @return HttpStatusInterface
     */
    protected function createHttpStatus(): HttpStatusInterface
    {
        return new NotImplemented;
    }
}
