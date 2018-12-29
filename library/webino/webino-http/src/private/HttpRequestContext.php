<?php

namespace Webino;

use Symfony\Component\Routing\RequestContext;

/**
 * Class RequestContext
 * @package webino-http
 */
class HttpRequestContext extends RequestContext
{
    /**
     * @param CreateInstanceEventInterface $event
     * @return HttpRequestContext
     */
    static function create(CreateInstanceEventInterface $event): HttpRequestContext
    {
        $container = $event->getContainer();
        $request = $container->get(HttpRequestInterface::class);

        $context = new static(
            $request->getBasePath(),
            $request->getMethod(),
            $request->getHost(), $request->getScheme(),
            $request->isHttps() ? 80 : $request->getPort(),
            $request->isHttps() ? $request->getPort() : 443,
            '',
            $request->getQueryString()
        );

        $context->setParameters(iterator_to_array($request));
        return $context;
    }

    /**
     * @param array $params
     */
    function addParameters(array $params): void
    {
        $this->setParameters($params + $this->getParameters());
    }
}
