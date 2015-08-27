<?php

namespace WebinoAppLib\Event;

use WebinoAppLib\Application\AbstractApplication;
use WebinoAppLib\Application\ConfiguredApplicationInterface;
use WebinoAppLib\Factory\ResponseFactory;
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
     * @return ResponseInterface|AbstractMessage
     */
    public function getResponse()
    {
        $response = $this->getEventParam($this::RESPONSE);
        if (empty($response)) {
            /** @var ResponseFactory $factory */
            $factory  = $this->getApp()->get(ResponseFactory::class);
            $response = $factory->createResponse();
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
        $this->setEventParam($this::RESPONSE, $response);
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
        $response->setContent($response->getContent() . $this->normalizeResponseContent($content));
        return $this;
    }

    /**
     * Set the content of a response
     *
     * @param string|array $content
     * @return self
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
        return (is_array($content) ? join(null, $content) : $content);
    }
}
