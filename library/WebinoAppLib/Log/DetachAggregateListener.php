<?php

namespace WebinoAppLib\Log;

/**
 * Class DetachAggregateListener
 */
class DetachAggregateListener extends AbstractInfoMessage
{
    /**
     * {@inheritdoc}
     */
    public function getMessage(...$args)
    {
        return sprintf(
            'Detaching aggregate listener `%s`',
            get_class($args[0])
        );
    }
}
