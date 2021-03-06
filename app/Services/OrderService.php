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

    public function showOrders($searchKey)
    {
        $orders = $this->orderModel::where('quantity', '!=' , 0)->paginate(12);


        if ($searchKey) {
            $products = $this->orderModel::where('name','like','%' . $searchKey . '%')
            ->paginate(12);
        }

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
                    'name' => $product->name,
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

        $productOrder = $this->productOrderModel::where('product_id',$productId)->first();

        $total_fee = $orderNew->total_fee - $productOrder->price * $productOrder->quantity;

        $orderNew->update([
            'total_fee' =>  $total_fee,
        ]);

        try {
            $productOrder->delete();
        } catch (\Exception $e) {
            \Log::error($e);
            
            return false;
        }
        
        return true;
    }


    public function changeQuantityProduct($productId, $quantity)
    {
        $productOrder = $this->productOrderModel::where('product_id',$productId)->first();
        $currentUser = auth()->user();
        $orderNew = $currentUser->orders()->where('status' , config('order.status.new'))->first();

        $total_fee = $orderNew->total_fee + $productOrder->price * $productOrder->quantity;

        try {
            $productOrder->update([
                'quantity' => $quantity,
            ]);

            $orderNew->update([
                'total_fee' => $total_fee,
            ]);

        } catch (\Exception $e) {
            \Log::error($e);
            
            return false;
        }
        return true;
    }
}