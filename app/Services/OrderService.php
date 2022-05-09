<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ProductOrder;

class OrderService extends BaseService
{
    protected $orderModel;
    public function __construct(Order $order)
    {
        $this->orderModel = $order;
    }

    public function showProductCart($user)
    {
        

        $order = $user->orders()->where('status', config('order.status.new'))
        ->first();

        $products = $order ? $order->products : [];

        $quantityArr = ProductOrder::where('order_id',$order->id)
        ->pluck('quantity', 'product_id')
        ->toArray();

        $totalPrice = Order::where('id',$order->id)
        ->pluck('total_fee')
        ->toArray();
        
        $array = [
            $products , 
            $quantityArr,
            $totalPrice,
        ]; 
        return $array;
    }
}