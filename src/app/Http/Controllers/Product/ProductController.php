<?php

namespace App\Http\Controllers\Product;

use App\Api\ProductApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $productApi;
    public function __construct(ProductApi $productApi)
    {
        $this->productApi = $productApi;
    }
    public function index(Request $request)
    {
        try {
            $site_id= $request->input('site_id');
             $data   = $this->productApi->getProducts($site_id);
            return response($data, 200);
            // return $data;
        //     dd($data);
        //             return api([
        //             'products' => $data,
        
        // ])->success(__('response.success'));
            // return response()->json(['message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch products'], 500);
        }
    }
    public function show(Request $request)
    {
        try {
            $site_id= $request->input('site_id');
            $product_id= $request->input('product_id');
            $data   = $this->productApi->showProduct($site_id,$product_id);
            return response($data, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch product'], 500);
        }
    }
}
