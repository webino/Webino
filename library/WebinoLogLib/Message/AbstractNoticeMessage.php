<?php

namespace WebinoLogLib\Message;

/**
 * Class AbstractNoticeMessage
 */
abstract class AbstractNoticeMessage implements MessageInterface
{
    /**
     * Message severity
     *
     * @return int
     */
    public function getLevel()
    {
        return $this::NOTICE;
    }
}
