<?php

namespace Webino\Exception;

use Webino\HttpStatus\NoContent;
use Webino\HttpStatusInterface;

/**
 * Class NoContentStatusException
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
