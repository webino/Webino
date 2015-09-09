<?php

namespace WebinoMailLib;

use Zend\Mail\Message;
use Zend\Mail\Transport\InMemory;
use Zend\Mail\Transport\TransportInterface;

/**
 * Class Mailer
 */
class Mailer implements MailerInterface
{
    /**
     * @var Message
     */
    private $message;

    /**
     * @var TransportInterface
     */
    private $transport;

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        if (null === $this->message) {
            $this->setMessage(new Message);
        }
        return $this->message;
    }

    /**
     * @param Message $message
     */
    public function setMessage(Message $message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTransport()
    {
        if (null === $this->transport) {
            $this->setTransport(new InMemory);
        }
        return $this->transport;
    }

    /**
     * @param TransportInterface $transport
     */
    public function setTransport(TransportInterface $transport)
    {
        $this->transport = $transport;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function send($recipient, $subject, $body)
    {
        $this->setRecipient($recipient);

        $message = $this->getMessage();

        $message->setSubject($subject)->setBody($body);

        // TODO attach files before sending the email

        // try to send the message
        $this->getTransport()->send($message);
    }

    /**
     * @param string|array $recipient
     */
    private function setRecipient($recipient)
    {
        $message = $this->getMessage();
        $message->getHeaders()->removeHeader('to');

        $recipients = is_array($recipient) ? $recipient : [$recipient];
        foreach ($recipients as $key => $value) {
            $hasName = is_string($key);
            $message->addTo($hasName ? $key : $value, $hasName ? $name : null);
        }
    }
}
