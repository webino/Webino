<?php

namespace Webino\Exception;

use Webino\HttpStatusInterface;

/**
 * Interface HttpStatusExceptionInterface
 */
interface HttpStatusExceptionInterface
{
    /**
     * @return HttpStatusInterface
     */
    public function getHttpStatus() : HttpStatusInterface;
}
