<?php

namespace WebinoAppLib\Log;

use WebinoLogLib\Message\AbstractInfoMessage;

/**
 * Class DetachAggregateListener
 */
class DetachAggregateListener extends AbstractInfoMessage
{
    /**
     * {@inheritdoc}
     */
    public function getMessage(array $args)
    {
        return 'Detaching aggregate listener {0}';
    }
}
