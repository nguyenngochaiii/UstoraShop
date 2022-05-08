<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{

    protected $productService;
    public function __construct(ProductService $service)
    {
        $this->productService = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productService->getProducts();

        return view('layout.products', compact('products'));
    }
    
    public function show($id)
    {   
        $products = $this->productService->showProduct($id);

        return view('layout.product', compact('product'));
    }
}