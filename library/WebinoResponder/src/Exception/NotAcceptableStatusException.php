<?php

namespace Webino\Exception;

use Webino\HttpStatus\NotAcceptable;
use Webino\HttpStatusInterface;

/**
 * Class NotAcceptableStatusException
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
