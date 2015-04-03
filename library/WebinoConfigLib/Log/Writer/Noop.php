<?php

namespace WebinoConfigLib\Log\Writer;

use WebinoConfigLib\AbstractConfig;

/**
 * Class Noop
 */
class Noop extends AbstractConfig
{

    public function __construct()
    {
        $this->mergeArray(['name' => 'noop']);
    }
}
