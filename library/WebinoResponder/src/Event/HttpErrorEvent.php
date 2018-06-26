<?php

namespace Webino\Event;

use Webino\Exception\HttpStatusExceptionInterface;
use Webino\HttpStatus\InternalServerError;
use Webino\HttpStatusInterface;

/**
 * Class HttpErrorEvent
 */
class HttpErrorEvent extends HttpResponseEvent
{
    use ErrorEventTrait;

    /**
     * @return HttpStatusInterface
     */
    public function getStatus(): HttpStatusInterface
    {
        if (!$this->status) {
            $exc = $this->getException();

            if ($exc instanceof HttpStatusExceptionInterface) {
                $this->status = $exc->getHttpStatus();
            } else {
                $this->status = new InternalServerError;
            }
        }

        return $this->status;
    }
}
