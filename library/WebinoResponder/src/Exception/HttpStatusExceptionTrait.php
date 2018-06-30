<?php

namespace Webino\Exception;

use Webino\HttpStatusInterface;

/**
 * Trait HttpStatusExceptionTrait
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
    public function getHttpStatus(): HttpStatusInterface
    {
        if (!$this->status) {
            $this->status = $this->createHttpStatus();
        }
        return $this->status;
    }
}
