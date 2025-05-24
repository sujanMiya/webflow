<?php
declare(strict_types=1);
namespace App\Api;
use App\Api\BaseApi;
use Apiz\Http\Response;

class ProductApi extends BaseApi
{
    
    /**
     * @param array $params
     * @return Response
     */
    public function getProducts($site_id): Response
    {
        return $this->get("{$site_id}/products");
    }
        /**
     * @param array $params
     * @return Response
     */
    public function showProduct($site_id,$product_id): Response
    {
        return $this->get("{$site_id}/products/{$product_id}");
    }
}