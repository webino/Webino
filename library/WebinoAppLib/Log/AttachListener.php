<?php

namespace WebinoAppLib\Log;

use WebinoLogLib\Message\AbstractInfoMessage;
use Zend\Stdlib\Parameters;

/**
 * Class AttachListener
 */
class AttachListener extends AbstractInfoMessage
{
    /**
     * {@inheritdoc}
     */
    public function getMessage(Parameters $args)
    {
        return 'Attaching {1} to an event {0} with priority {2}';
    }
}
