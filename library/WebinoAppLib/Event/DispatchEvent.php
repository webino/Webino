<?php

namespace WebinoAppLib\Event;

use WebinoAppLib\Application\AbstractApplication;
use WebinoAppLib\Application\ConfiguredApplicationInterface;
use WebinoBaseLib\Util\ToString;
use Zend\Http\AbstractMessage;
use Zend\Stdlib\RequestInterface;
use Zend\Stdlib\ResponseInterface;

/**
 * Class DispatchEvent
 */
class DispatchEvent extends AppEvent implements
    DispatchEventInterface
{
    /**
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
        return $this->getEventParam($this::REQUEST);
    }

    /**
     * @param RequestInterface $request
     * @return $this
     */
    public function setRequest(RequestInterface $request)
    {
        $this->setEventParam($this::REQUEST, $request);
        return $this;
    }

    /**
     * @return ResponseInterface|AbstractMessage
     */
    public function getResponse()
    {
        return $this->getEventParam($this::RESPONSE);
    }

    /**
     * @param ResponseInterface $response
     * @return $this
     */
    public function setResponse(ResponseInterface $response)
    {
        $this->setEventParam($this::RESPONSE, $response);
        return $this;
    }

    /**
     * Append the content to a response
     *
     * @param string|array $content
     * @return $this
     */
    public function setResponseContent($content)
    {
        $response = $this->getResponse();
        $response->setContent($response->getContent() . $this->normalizeResponseContent($content));
        return $this;
    }

    /**
     * Set the content of a response
     *
     * @param string|array $content
     * @return $this
     */
    public function resetResponseContent($content = null)
    {
        $this->getResponse()->setContent($this->normalizeResponseContent($content));
        return $this;
    }

    /**
     * @param string|array $content
     * @return string
     */
    private function normalizeResponseContent($content)
    {
        return ToString::value($content);
    }
}
