<?php

namespace WebinoAppLib\Log;

use WebinoLogLib\Message\AbstractInfoMessage;
use Zend\Stdlib\Parameters;

/**
 * Class AttachAggregateListener
 */
class AttachAggregateListener extends AbstractInfoMessage
{
    /**
     * {@inheritdoc}
     */
    public function getMessage(Parameters $args)
    {
        return 'Attaching aggregate listener {0}';
    }
}
