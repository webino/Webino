<?php

namespace Webino\Exception;

use Webino\HttpStatus\InternalServerError;
use Webino\HttpStatusInterface;

/**
 * Class InternalServerErrorStatusException
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
