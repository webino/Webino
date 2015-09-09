<?php

namespace WebinoAppLib\Contract;

/**
 * Interface MailerInterface
 */
interface MailerInterface
{
    /**
     * @return MailerInterface
     */
    public function getMailer();

    /**
     * @return \WebinoMailLib\MailerInterface
     */
    public function mail();
}
