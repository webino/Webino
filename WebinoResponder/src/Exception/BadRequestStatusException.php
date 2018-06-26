<?php

namespace Webino\Exception;

use Webino\HttpStatus\BadRequest;
use Webino\HttpStatusInterface;

/**
 * Class BadRequestStatusException
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
