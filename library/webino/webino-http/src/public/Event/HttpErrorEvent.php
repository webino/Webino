<?php

namespace Webino;

use Webino\HttpStatus\InternalServerError;

/**
 * Class HttpErrorEvent
 * @package webino-http
 */
class HttpErrorEvent extends HttpResponseEvent
{
    use ErrorEventTrait;

    /**
     * @return HttpStatusInterface
     */
    function getStatus(): HttpStatusInterface
    {
        if (empty($this['status'])) {
            $exc = $this->getException();

            if ($exc instanceof HttpStatusExceptionInterface) {
                $this['status'] = $exc->getHttpStatus();
            } else {
                $this['status'] = new InternalServerError;
            }
        }

        return $this['status'];
    }
}
