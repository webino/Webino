<?php

namespace WebinoAppLib\Event;

use WebinoEventLib\Event;

/**
 * Class AbstractAppEvent
 */
abstract class AbstractAppEvent extends Event
{
    /**
     * @return \WebinoAppLib\Application
     */
    public function getTarget()
    {
        return parent::getTarget();
    }

    /**
     * Set the content of a response
     *
     * @param string $content
     */
    public function setResponseContent($content)
    {
        $this->getTarget()->getResponse()->setContent((string) $content);
    }
}
