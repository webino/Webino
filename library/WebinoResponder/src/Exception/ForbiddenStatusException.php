<?php

namespace Webino\Exception;

use Webino\HttpStatus\Forbidden;
use Webino\HttpStatusInterface;

/**
 * Class ForbiddenStatusException
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
