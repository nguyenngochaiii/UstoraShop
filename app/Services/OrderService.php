<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ProductOrder;
use App\Models\Product;


class OrderService extends BaseService
{
    protected $orderModel;
    protected $productOrderModel;
    protected $productModel;

    public function __construct(Order $order, ProductOrder $productOrder,Product $product)
    {
        $this->orderModel = $order;
        $this->productOrderModel = $productOrder;
        $this->productModel = $product;
    }

    public function showOrders()
    {
        $orders = $this->orderModel::paginate(20);

        return $orders;
    }

    public function showProductCart($user)
    {
        $order = $user->orders()->where('status', config('order.status.new'))
        ->first();

        $products = $order ? $order->products : [];

        $quantityArr = $this->productOrderModel::where('order_id',$order->id)
        ->pluck('quantity', 'product_id')
        ->toArray();

        $totalPrice = $order->total_fee;
   
        $countProducts = count($products);

        return compact('products', 
            'quantityArr',
            'totalPrice',
            'countProducts'
        );
    }

    public function addProductToCart($productId)
    {
        $product = $this->productModel::find($productId);

        $currentUserId = auth()->id();
        $new = config('order.status.new');

        $order =  $this->orderModel::where('user_id',$currentUserId)
        ->where('status', $new)
        ->first();

        if($order){
            $total_fee = $order->total_fee + $product->price;
        }else {
            $total_fee = $product->price;
        }

        try {
            $isCreateProductOrder = false;
           if (!$order){
                $orderData = [
                    'user_id' => $currentUserId,
                    'product_id' => $productId,
                    'coupon_id' => 1,
                    'total_fee' =>$total_fee,
                    'status' => $new,
                    'quantity' => 1,
                ];

                $order = $this->orderModel::create($orderData);
                $isCreateProductOrder = true;
           } else {
                $productOrder = $this->productOrderModel::where('order_id', $order->id)
                ->where('product_id', $product->id)
                ->first();
                
                if($productOrder){
                    $productOrder->increment('quantity');
                }else {
                    $isCreateProductOrder = true;
                }

                $order->update([
                    'total_fee' => $total_fee,
                ]);
           }
           if($isCreateProductOrder){
                $orderProductData = [
                    'product_id' => $productId,
                    'order_id' => $order->id,
                    'quantity' => 1,
                    'price' => $product->price,  
                ];  
                
                $this->productOrderModel::create($orderProductData);
           }
        } catch (Exception $e) {
            Log::error($e);

            return [
                'status' => false,
                'msg' => 'some thing wrong',
            ];;
        }

        return [
            'status' => true,
        ];
    }

    public function deleteProductCart($productId)
    {
        $currentUser = auth()->user();
        $orderNew = $currentUser->orders()->where('status' , config('order.status.new'))->first();

        $product = $orderNew->products()->where('product_id', $productId)->first();

        $total_fee = $orderNew->total_fee - $product->price * $product->pivot->quantity;

        $orderNew->update([
            'total_fee' =>  $total_fee,
        ]);

        try {
            $product->delete();
        } catch (\Exception $e) {
            \Log::error($e);
            
            return false;
        }
        
        return true;
    }
}