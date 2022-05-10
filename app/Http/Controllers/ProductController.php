<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Services\ProductService;
use App\Services\OrderService;

class ProductController extends Controller
{

    protected $productService;
    protected $orderService;
    public function __construct(ProductService $productService,OrderService $orderService)
    {
        $this->productService = $productService;
        $this->orderService = $orderService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = auth()->user();
        $products = $this->productService->getProducts();
        
        $array = $this->orderService->showProductCart($currentUser);

        return view('layout.products', $array )->with(compact('products'));
    }
    
    public function show($id)
    {   
        $currentUser = auth()->user();

        $product = $this->productService->showProduct($id);
        $products = Product::paginate(5);

        $array = $this->orderService->showProductCart($currentUser);
        return view('layout.product', $array )->with(compact('product','products'));
    }
}