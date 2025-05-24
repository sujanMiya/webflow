<?php
declare(strict_types=1);
namespace App\Api;
use App\Api\BaseApi;
use Apiz\Http\Response;

class OrderApi extends BaseApi
{
    
    /**
     * @param array $params
     * @return Response
     */
    public function getOrders($site_id): Response
    {
        return $this->get("{$site_id}/orders");
    }
    /**
     * @param array $params
     * @return Response
     */
    public function show($site_id, $order_id): Response
    {
        return $this->get("{$site_id}/order/{$order_id}");
    }
}