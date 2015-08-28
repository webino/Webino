<?php

namespace WebinoAppLib\Feature;

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
        return 'http';
    }
}
