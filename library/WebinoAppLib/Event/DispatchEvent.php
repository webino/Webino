<?php

namespace WebinoAppLib\Event;

use WebinoAppLib\Application\AbstractApplication;
use WebinoAppLib\Application\ConfiguredApplicationInterface;
use Zend\Http\Response\Stream;
use Zend\Mvc\Service\ResponseFactory;
use Zend\Stdlib\RequestInterface;
use Zend\Stdlib\ResponseInterface;

/**
 * Class DispatchEvent
 */
class DispatchEvent extends AppEvent
{
    /**
     * Request param name
     */
    const REQUEST = 'request';

    /**
     * Response param name
     */
    const RESPONSE = 'response';

    /**
     * DispatchEvent constructor.
     *
     * @param ConfiguredApplicationInterface|AbstractApplication $app
     */
    public function __construct(ConfiguredApplicationInterface $app)
    {
        parent::__construct(AppEvent::DISPATCH);
        $this->setApp($app);
    }

    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->getParam($this::REQUEST);
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        $response = $this->getParam($this::RESPONSE);
        if (empty($response)) {
            $response = (new ResponseFactory)->createService($this->getApp()->getServices());
            $this->setResponse($response);
        }

        return $response;
    }

    /**
     * @param ResponseInterface $response
     * @return self
     */
    public function setResponse(ResponseInterface $response)
    {
        $this->setParam($this::RESPONSE, $response);
        return $this;
    }

    /**
     * Append the content to a response
     *
     * @param string|array $content
     * @return self
     */
    public function setResponseContent($content)
    {
        $response = $this->getResponse();
        $response->setContent($response->getContent() . (is_array($content) ? join(null, $content) : $content));
        return $this;
    }

    /**
     * Set the content of a response
     *
     * @param string $content
     * @return self
     */
    public function resetResponseContent($content = null)
    {
        $this->getResponse()->setContent($content);
        return $this;
    }

    /**
     * @param string|resource $pathOrStream
     * @return self
     */
    public function setResponseStream($pathOrStream)
    {
        $resource = is_resource($pathOrStream) ? $pathOrStream : fopen($pathOrStream, 'r');
        $stream   = new Stream;

        $stream->setStream($resource);
        $this->setResponse($stream);

        return $this;
    }

    // TODO decouple to Stream response
    public function setForceDownload()
    {
        $this->getResponse()->getHeaders()->addHeaderLine('Content-type', 'application/force-download');
        return $this;
    }
}
