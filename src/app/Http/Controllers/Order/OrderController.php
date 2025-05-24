<?php

namespace App\Http\Controllers\Order;

use App\Api\OrderApi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderApi;
    public function __construct(OrderApi $orderApi)
    {
        $this->orderApi = $orderApi;
    }
    public function index(Request $request)
    {
        try {
            $site_id = $request->input('site_id');
            $orders = $this->orderApi->getOrders($site_id);
            if(!$orders){
                return response()->json(['error' => 'No orders found'], 404);
            }
            return response($orders, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch orders'], 500);
        }
    }
    public function show(Request $request)
    {
        try {
            $site_id = $request->input('site_id');
            $order_id = $request->input('order_id');
            if (!$site_id || !$order_id) {
                return response()->json(['error' => 'Site ID and Order ID are required'], 400);
            }
            $order = $this->orderApi->show($site_id, $order_id);
            if(!$order){
                return response()->json(['error' => 'Order not found'], 404);
            }
            return response($order, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch order'], 500);
        }
    }
}
