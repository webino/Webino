<?php

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
