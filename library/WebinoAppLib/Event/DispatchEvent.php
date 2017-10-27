<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
     * Set response
     *
     * It sets response content when response is a string.
     * It joins values to a string when response is an array.
     * It converts to string when response is an object.
     * It sets response object when response is an interface.
     *
     * @param string|array|ResponseInterface $response
     * @return $this
     */
    public function setResponse($response)
    {
        if ($response instanceof ResponseInterface) {
            $this->setEventParam($this::RESPONSE, $response);
            return $this;
        }

        $_response = $this->getResponse();
        $_response->setContent($_response->getContent() . $this->normalizeResponseContent($response));
        return $this;
    }

    /**
     * Reset response
     *
     * @param string|array|ResponseInterface $response
     * @return $this
     */
    public function resetResponse($response = null)
    {
        if ($response instanceof ResponseInterface) {
            // TODO implement??
            return $this;
        }
        $this->getResponse()->setContent($this->normalizeResponseContent($response));
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
