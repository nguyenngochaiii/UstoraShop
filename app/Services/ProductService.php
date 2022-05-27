<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductService extends BaseService
{
    protected $productModel;
    public function __construct(Product $product)   
    {
        $this->productModel = $product;
    }

    public function getProducts($searchKey)
    {
        $products = $this->productModel->where('quantity', '!=' , 0)->orderBy('id', 'desc')->paginate(12);
        
        if ($searchKey) {
            $products = $this->productModel->where('name','like','%' . $searchKey . '%')
            ->orderBy('id', 'desc')->paginate(12);
        }
        
        return $products;
    }

    public function showProduct($id)
    {
        $product = $this->productModel->findOrFail($id);
        
        return $product;
    }

    public function createProduct($data)
    {
        try {
            $product = $this->productModel->create($data);
        } catch (\Exception $e) {
            \Log->error($e);
            
            return false;
        }
        
        return $product;
    }

    public function updateProduct($data , $id)
    {
        $product = $this->productModel->findOrFail($id);

        try {
            $product->update($data);
        } catch (\Exception $e) {
            \Log->error($e);
            
            return false; //err meg
        }

        return $product;
    }

    public function editProduct($id)
    {
        $product = $this->productModel->findOrFail($id);
        return $product;
    }


    public function deleteProduct($id)
    {
        $product = $this->productModel->findOrFail($id);

        try {
            $product->delete();
        } catch (\Exception $e) {
            \Log->error($e);
            
            return back()->with('error','Delete Failed  Sir !!'); //err meg
        }

        return $product;
    }

}