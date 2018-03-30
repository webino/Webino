<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\App\Application\Traits;

use Webino\App\Application;
use Webino\Mail\MailerInterface;

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
