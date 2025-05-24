<?php 
declare(strict_types=1);

use App\Utilities\ApiJsonResponse;
use Illuminate\Contracts\Support\Arrayable;

if (!function_exists('api')) {
    /**
     * @param array|Arrayable|string|null $data
     * @return ApiJsonResponse
     */
    function api(array|Arrayable|string|null $data = []): ApiJsonResponse
    {
        return new ApiJsonResponse($data);
    }
}