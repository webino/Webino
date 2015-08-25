<?php

namespace WebinoHtmlLib;

use WebinoBaseLib\Util\SingletonTrait;
use Zend\Escaper\Escaper as BaseEscaper;

/**
 * Escaper Singleton
 */
class Escaper extends BaseEscaper
{
    use SingletonTrait;

    /**
     * {@inheritdoc}
     */
    public function __construct($encoding = 'utf-8')
    {
        parent::__construct($encoding);
    }
}
