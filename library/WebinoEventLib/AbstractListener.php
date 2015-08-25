<?php

namespace WebinoEventLib;

use Zend\EventManager\ListenerAggregateInterface;

/**
 * Class AbstractListener
 */
abstract class AbstractListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;
}
