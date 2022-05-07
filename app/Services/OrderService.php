<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderService extends BaseService
{
    protected $orderModel;
    public function __construct(Order $order)
    {
        $this->orderModel = $order;
    }


    public function showOrder()
    {
        $orders = $this->orderModel::paginate(20);
    }
    
}