<?php

namespace WebinoAppLib\Log;

use Zend\Stdlib\CallbackHandler;

/**
 * Class DetachListener
 */
class DetachListener extends AbstractInfoMessage
{
    /**
     * {@inheritdoc}
     */
    public function getMessage(...$args)
    {
        if ($args[1] instanceof CallbackHandler) {
            $mData = $args[1]->getMetadata();
            $args = [
                $mData['event'],
                $args[1]->getCallback(),
                $mData['priority'],
            ];
        }

        /** @noinspection PhpParamsInspection */
        return sprintf(
            'Detaching `%s` from an event `%s` with priority `%s`',
            get_class($args[1]),
            $args[0],
            $args[2]
        );
    }
}
