<?php

namespace Webino;

/**
 * Class HttpServer
 * @package webino-http
 */
class HttpServer extends AbstractHttpServer
{
    /**
     * @return iterable
     */
    protected function createParams(): iterable
    {
        return $_SERVER;
    }
}
