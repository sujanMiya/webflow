<?php
declare(strict_types=1);
namespace App\Api;
use App\Api\BaseApi;
use Apiz\Http\Response;

class OrdersApi extends BaseApi
{
    
    /**
     * @param array $params
     * @return Response
     */
    public function getOrders(): Response
    {
        return $this->get('6346f9331996dfeca833ab25/products');
    }
}