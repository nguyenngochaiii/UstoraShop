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

    public function getProducts()
    {
        $products = $this->productModel::where('quantity','!=',0)->paginate(12);

        
        
        return $products;
    }

    public function showProduct()
    {
        $product = $this->productModel::findOrFail($id);
        
        return $products;
    }
}