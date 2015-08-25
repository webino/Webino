<?php

namespace WebinoAppLib\Factory;

use WebinoAppLib\Response\HtmlResponse;
use Zend\Console;

/**
 * Class ResponseFactory
 */
class ResponseFactory extends AbstractFactory
{
    /**
     * Create a response
     *
     * @return \Zend\Stdlib\ResponseInterface
     */
    public function createResponse()
    {
        if (Console\Console::isConsole()) {
            return new Console\Response;
        }
        return new HtmlResponse;
    }

    /**
     * Create a service
     *
     * @return mixed
     */
    protected function create()
    {
        return $this;
    }
}
