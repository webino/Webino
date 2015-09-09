<?php

namespace WebinoAppLib\Factory;

use WebinoConfigLib\Feature\AbstractMailer;
use WebinoMailLib\Factory;

/**
 * Class MailerFactory
 */
class MailerFactory extends AbstractFactory
{
    /**
     * Create a mailer
     *
     * @return \WebinoMailLib\MailerInterface
     * @throws Exception\InvalidArgumentException Unable to create a logger
     */
    protected function create()
    {
        return (new Factory)->create($this->getConfig(AbstractMailer::KEY));
    }
}
