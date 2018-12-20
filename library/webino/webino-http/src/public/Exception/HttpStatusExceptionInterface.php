<?php

namespace Webino;

/**
 * Interface HttpStatusExceptionInterface
 * @package webino-http
 */
interface HttpStatusExceptionInterface
{
    /**
     * @return HttpStatusInterface
     */
    function getHttpStatus(): HttpStatusInterface;
}
