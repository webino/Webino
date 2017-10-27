<?php

namespace WebinoViewLib\Component\Javascript;

/**
 * Class BootstrapV3
 */
class BootstrapV3 extends AbstractBootstrap
{
    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct('//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js');
    }
}
