<?php

namespace Webino\Exception;

use Webino\HttpStatus\NotFound;
use Webino\HttpStatusInterface;

/**
 * Class NotFoundStatusException
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
