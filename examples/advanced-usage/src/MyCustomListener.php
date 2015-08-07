<?php

/**
 * Class MyCustomListener
 */
class MyCustomListener extends \WebinoEventLib\AbstractListener
{
    /**
     * Initialize listener
     */
    public function init()
    {
        $this->listen(\WebinoAppLib\Event\AppEvent::DISPATCH, function () {
            echo 'Webino Application Advanced Usage Example';
        });
    }
}
