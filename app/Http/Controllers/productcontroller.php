<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class productcontroller extends websitecontroller
{
    public function index(Request $request)
    {   
        $cart=$request->session()->has('cart') ? $request->session()->get('cart') : null;

        $products=Product::all();
        return view('website.index',compact('products','cart'));
    }
    public function showproduct($id,Request $request)
    {
        $cart=$request->session()->has('cart') ? $request->session()->get('cart') : null;
        $product=Product::findOrfail($id);
        return view('website.product.show',compact('product','cart'));
        
    }
}
