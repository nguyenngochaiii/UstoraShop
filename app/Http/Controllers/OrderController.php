<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductOrder;
use Exception;
use Log;
use App\Services\OrderService;

class OrderController extends Controller
{

    protected $orderService;

    public function __construct(OrderService $service)
    {
        $this->orderService = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->check()) {
            return redirect('login');
        }

        $currentUser = auth()->user();

        dd($currentUser);


        return view('layout.cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productId = $request->product_id;
        $product = Product::find($productId);

        if(!$product){
            return json_encode([
                'status' => false,
            ]);
        }

        if (!auth()->check()) {
            return json_encode([
                'status' => false,
                'msg' => 'Need Login',
            ]);
        }

        $currentUserId = auth()->id();
        $new = config('order.status.new');

        $order = Order::where('user_id',$currentUserId)
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

                $order = Order::create($orderData);
                $isCreateProductOrder = true;
           } else {
                $productOrder = ProductOrder::where('order_id', $order->id)
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
                
                ProductOrder::create($orderProductData);
           }
        } catch (Exception $e) {
            Log::error($e);
        }

        return json_encode([
            'status' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}