<?php

namespace Webino;

/**
 * Trait HttpStatusExceptionTrait
 * @package webino-http
 */
trait HttpStatusExceptionTrait
{
    /**
     * @var HttpStatusInterface
     */
    protected $status;

    /**
     * @return HttpStatusInterface
     */
    abstract protected function createHttpStatus(): HttpStatusInterface;

    /**
     * @return HttpStatusInterface
     */
    function getHttpStatus(): HttpStatusInterface
    {
        if (!$this->status) {
            $this->status = $this->createHttpStatus();
        }
        return $this->status;
    }
}
