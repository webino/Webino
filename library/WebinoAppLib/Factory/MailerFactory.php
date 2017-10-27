<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
     * @throws \WebinoAppLib\Exception\InvalidArgumentException Unable to create a logger
     */
    protected function create()
    {
        return (new Factory)->create($this->getConfig(AbstractMailer::KEY));
    }
}
