<?php

namespace WebinoMailLib;

/**
 * Interface MailerInterface
 */
interface MailerInterface
{
    /**
     * Returns this service's message
     *
     * @return \Zend\Mail\Message
     */
    public function getMessage();

    /**
     * @return \Zend\Mail\Transport\TransportInterface
     */
    public function getTransport();

    /**
     * @param string|array $recipient
     * @param string $subject
     * @param string $body
     */
    public function send($recipient, $subject, $body);
}
