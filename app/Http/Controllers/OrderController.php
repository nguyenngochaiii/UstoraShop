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
use App\Services\ProductService;

class OrderController extends Controller
{

    protected $orderService;
    protected $productService;

    public function __construct(OrderService $orderService,ProductService $productService)
    {
        $this->orderService = $orderService;
        $this->productService = $productService;
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
        
        $array = $this->orderService->showProductCart($currentUser);

        return view('layout.cart', $array);
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
        $product = Product::find($request->product_id);

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
        
        $isSuccess = $this->orderService->addProductToCart($request->product_id);

        if (!$isSuccess){
            return json_encode([
                'status' => false,
                'msg' => 'add not success',
            ]);
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
    public function destroy($productId)
    {

        $deletedFlag = $this->orderService->deleteProductCart($productId);

        $message = "Delete success!!! ";
        if (!$deletedFlag){
            $message = "Delete False!!!";
        }

        return back()->with('status', $message );
    }
}