<?php

namespace Webino;

use Webino\HttpStatus\NoContent;

/**
 * Class NoContentStatusException
 * @package webino-responder
 */
class NoContentStatusException extends RuntimeException implements
    HttpStatusExceptionInterface
{
    use HttpStatusExceptionTrait;

    /**
     * @return HttpStatusInterface
     */
    protected function createHttpStatus(): HttpStatusInterface
    {
        return new NoContent;
    }
}
