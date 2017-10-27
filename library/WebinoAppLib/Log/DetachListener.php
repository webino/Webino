<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Log;

use WebinoLogLib\Message\AbstractInfoMessage;
use Zend\Stdlib\CallbackHandler;
use Zend\Stdlib\Parameters;

/**
 * Class DetachListener
 */
class DetachListener extends AbstractInfoMessage
{
    /**
     * {@inheritdoc}
     */
    public function getMessage(Parameters $args)
    {
        // TODO remove CallbackHandler support, case deprecated by Zend
        if ($args[1] instanceof CallbackHandler) {
            $mData = $args[1]->getMetadata();
            $args->handler  = $args[1]->getCallback();
            $args->event    = $mData['event'];
            $args->priority = $mData['priority'];
        } else {
            $args->handler  = get_class($args[1]);
            $args->event    = $args[0];
            $args->priority = $args[2];
        }

        return 'Detaching {handler} from an event {event} with priority {priority}';
    }
}
