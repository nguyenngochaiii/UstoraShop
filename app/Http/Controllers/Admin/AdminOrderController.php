<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;

class AdminOrderController extends Controller
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
    public function index(Request $request)
    {
        $orders = $this->orderService->showOrders($request->search);
        return view('admin.orders.index' , [
            'status' => array_flip(config('order.status')),
        ])->with(compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $order = $this->orderService->createOrder($data);

        if (!$order) {
            return back()->withInput($data)->with('error','Create Failed  Sir !!');
        }
         
        return redirect()->route('admin.orders.edit' , $order->id)->with('status', 'Create success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->orderService->editOrder($id);
        return view('admin.orders.edit', compact('order'));
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
        $data = $request->all();
        
        $order = $this->orderService->updateOrder($data , $id);

        if(!$order){
            return back()->withInput($data)->with('error','Update Failed  Sir !!');
        }

        return redirect()->route('admin.orders.edit' , $order->id)->with('status', 'Update success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = $this->orderService->deleteOrder($id);

        if(!$order){
            return back()->with('error','Delete Failed  Sir !!');
        }

        return redirect()->route('admin.orders.index')->with('status', 'Delete success!');
    }
}