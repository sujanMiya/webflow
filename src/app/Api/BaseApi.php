<?php 
declare(strict_types=1);
namespace App\Api;
use Apiz\AbstractApi;

class BaseApi extends AbstractApi
{
     /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return 'https://api.webflow.com';
	}
        /**
     * @return string
     */
    public function getPrefix(): string
    {
        return '/v2/sites';
    }

    /**
     * @return array
     */
    public function getDefaultHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . 'dfe08b86e580c9ea4c93a68c801a068dc7a7f17abade63188d058999acaa8391',
            'Accept' => 'application/json'
        ];
    }
}