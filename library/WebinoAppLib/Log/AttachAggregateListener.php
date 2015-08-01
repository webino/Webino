<?php

namespace WebinoAppLib\Log;

/**
 * Class AttachAggregateListener
 */
class AttachAggregateListener extends AbstractInfoMessage
{
    /**
     * {@inheritdoc}
     */
    public function getMessage(...$args)
    {
        return sprintf(
            'Attaching aggregate listener `%s`',
            get_class($args[0])
        );
    }
}
