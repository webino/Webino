<?php

namespace Webino;

/**
 * Class BootstrapCssView
 * @package webino-system
 */
class BootstrapCssView extends View\AbstractCssLink
{
    /**
     * @param ViewEvent $event
     * @return mixed
     */
    function getLink(ViewEvent $event)
    {
        return [
            'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css',
            'sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO'
        ];
    }
}
