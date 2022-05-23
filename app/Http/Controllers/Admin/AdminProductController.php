<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;

class AdminProductController extends Controller
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
    public function index(Request $request)
    {
        $products = $this->productService->getProducts($request->search);
        return view('admin.products.index')->with(compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest  $request)
    {
        $data = $request->all();

        $product = $this->productService->createProduct($data);

        if (!$product) {
            return back()->withInput($data)->with('error','Create Failed  Sir !!');
        }
         
        return redirect()->route('admin.products.edit' , $product->id)->with('status', 'Create success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productService->showProduct($id);

        return view('components.product')->with(compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productService->editProduct($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $data = $request->all();
        
        $product = $this->productService->updateProduct($data , $id);

        if(!$product){
            return back()->withInput($data)->with('error','Update Failed  Sir !!');
        }

        return redirect()->route('admin.products.edit' , $product->id)->with('status', 'Update success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->productService->deleteProduct($id);

        if(!$product){
            return back()->with('error','Delete Failed  Sir !!');
        }

        return redirect()->route('admin.products.index')->with('status', 'Delete success!');
    }
}