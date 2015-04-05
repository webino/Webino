<?php

namespace WebinoAppLib\Log;

/**
 * Class AttachListener
 */
class AttachListener extends AbstractInfoMessage
{
    /**
     * {@inheritdoc}
     */
    public static function getMessage(...$args)
    {
        /** @noinspection PhpParamsInspection */
        return sprintf(
            'Attaching `%s` to an event `%s` with priority `%s`',
            get_class($args[1]),
            is_string($args[0]) ? $args[0] : get_class($args[0]),
            $args[2]
        );
    }
}
