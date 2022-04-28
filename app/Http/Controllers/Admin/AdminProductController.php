<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.   
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::paginate(20);
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
        $data = $request->only([
            'name',
            'price',
            'quantity',
        ]);
        
        try {
            $product = Product::create($data);
        } catch (\Exception $e) {
            \Log::error($e);
            
            return back()->withInput($data)->with('error','Something Wrong Sir !!'); //err meg
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
        $product = Product::findOrFail($id);

        return view('components.product-details')->with(compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
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
        $product = Product::findOrFail($id);

        $data = $request->only([
            'name',
            'price',
            'quantity',
        ]);

        try {
            $product->update($data);
        } catch (\Exception $e) {
            \Log::error($e);
            
            return back()->withInput($data)->with('error','Update Failed  Sir !!'); //err meg
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
        $product = Product::findOrFail($id);

        try {
            $product->delete();
        } catch (\Exception $e) {
            \Log::error($e);
            
            return back()->with('error','Delete Failed  Sir !!'); //err meg
        }

        return redirect()->route('admin.products.index')->with('status', 'Delete success!');
    }
}