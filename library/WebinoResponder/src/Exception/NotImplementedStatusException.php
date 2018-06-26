<?php

namespace Webino\Exception;

use Webino\HttpStatus\NotImplemented;
use Webino\HttpStatusInterface;

/**
 * Class NotImplementedStatusException
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
