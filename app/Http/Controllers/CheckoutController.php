<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Events\MyEvent;
use App\Models\Notification;
use App\Models\Product;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = auth()->user();
        $orderNew = $currentUser->orders()->where('status' , config('order.status.new'))->first();

        $total_fee = $orderNew->total_fee;

        $order = $currentUser->orders()->where('status', config('order.status.new'))
        ->first();

        $products = $order ? $order->products : [];

        $listProduct = Product::inRandomOrder()->limit(5)->paginate(4);

        return view('layout.checkout',[
            'total_fee' => $total_fee,
            'products' => $products,
            'listProduct' => $listProduct,
        ]);
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
        $currentUser = auth()->user();

        $orderId = $currentUser->orders()->where('status', config('order.status.new'))->pluck('id')->first();
        
        event(new MyEvent([
            'username' => $currentUser->name,
        ]));

        $message = $currentUser->name . ' đã đặt hàng';

        $data = [
            'user_id' => auth()->id(),
            'order_id' => $orderId,
            'content' => $message,
            'read' => 0, //unread
        ];

        try {
            $notifications = Notification::create($data);
        } catch (\Exception $e) {
            \Log::error($e);
            
            return false;
        }

        return redirect('checkout');
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