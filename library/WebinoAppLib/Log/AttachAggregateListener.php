<?php

namespace WebinoAppLib\Log;

use WebinoLogLib\Message\AbstractInfoMessage;

/**
 * Class AttachAggregateListener
 */
class AttachAggregateListener extends AbstractInfoMessage
{
    /**
     * {@inheritdoc}
     */
    public function getMessage(array $args)
    {
        return 'Attaching aggregate listener {0}';
    }
}
