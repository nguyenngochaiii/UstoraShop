<?php

namespace App\Services\Admin;

use App\Services\BaseService;
use DB;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderAdminService extends BaseService
{
    protected $orderModel;
    public function __construct(Order $order)
    {
        $this->orderModel = $order;
    }


    public function getOrders()
    {
        $orders = $this->orderModel::paginate(20);

        return $orders;
    }
    
    // public function showOrder($id)
    // {
    //     $order = $this->orderModel::findOrFail($id);
    //     return $order;
    // }
}