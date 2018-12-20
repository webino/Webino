<?php

namespace Webino;

use Webino\HttpStatus\ServiceUnavailable;

/**
 * Class ServiceUnavailableStatusException
 * @package webino-responder
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
