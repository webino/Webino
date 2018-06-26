<?php

namespace Webino\Exception;

use Webino\HttpStatus\ServiceUnavailable;
use Webino\HttpStatusInterface;

/**
 * Class ServiceUnavailableStatusException
 */
class ServiceUnavailableStatusException extends RuntimeException implements
    HttpStatusExceptionInterface
{
    use HttpStatusExceptionTrait;

    /**
     * @return HttpStatusInterface
     */
    protected function createHttpStatus(): HttpStatusInterface
    {
        return new ServiceUnavailable;
    }
}
