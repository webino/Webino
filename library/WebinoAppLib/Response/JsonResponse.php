<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Response;

use Zend\Json\Json;

/**
 * Class JsonResponse
 */
class JsonResponse extends AbstractHttpResponse
{
    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setContent(Json::encode($data));
        $this->setContentType('application/json');
    }
}
