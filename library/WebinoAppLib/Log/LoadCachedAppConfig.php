<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Log;

use WebinoLogLib\Message\AbstractInfoMessage;
use Zend\Stdlib\Parameters;

/**
 * Class LoadCachedAppConfig
 */
class LoadCachedAppConfig extends AbstractInfoMessage
{
    /**
     * {@inheritdoc}
     */
    public function getMessage(Parameters $args)
    {
        return 'Loading cached application configuration';
    }
}
