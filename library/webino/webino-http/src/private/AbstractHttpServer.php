<?php

namespace Webino;

/**
 * Class AbstractHttpServer
 * @package webino-http
 */
abstract class AbstractHttpServer implements HttpServerInterface, \ArrayAccess
{
    use HttpContextTrait;
}
