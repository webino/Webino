<?php

namespace WebinoAppLib\Feature;

use WebinoAppLib\Context\HttpContext;

/**
 * Class HttpListener
 */
class HttpListener extends AbstractContextListener
{
    /**
     * @return string
     */
    protected function getKey()
    {
        return HttpContext::class;
    }
}
