<?php

namespace WebinoAppLib\Application\Traits;

use WebinoAppLib\Application;
use WebinoConfigLib\Feature\AbstractLog;
use WebinoLogLib\LoggerInterface;
use WebinoLogLib\Factory;
use WebinoLogLib\Message\MessageInterface;
use WebinoMailLib\MailerInterface;

/**
 * Trait Mailer
 */
trait MailerTrait
{
    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * Set optional service from services into application
     *
     * @param string $service Service name
     */
    abstract protected function optionalService($service);

    /**
     * @return MailerInterface
     */
    public function getMailer()
    {
        if (null === $this->mailer) {
            $this->optionalService(Application::MAILER);
        }
        return $this->mailer;
    }

    /**
     * @param MailerInterface $mailer
     */
    protected function setMailer(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @return MailerInterface
     */
    public function mail()
    {
        return $this->getMailer();
    }
}
