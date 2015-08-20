<?php

namespace WebinoAppLib\Log;

use WebinoLogLib\Message\AbstractInfoMessage;

/**
 * Class AttachListener
 */
class AttachListener extends AbstractInfoMessage
{
    /**
     * {@inheritdoc}
     */
    public function getMessage(array $args)
    {
        return 'Attaching {1} to an event {0} with priority {2}';
    }
}
