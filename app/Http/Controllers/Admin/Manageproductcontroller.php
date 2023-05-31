<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use App\Models\Category; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Manageproductcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    
    {   
        $products=Product::all();
        return view('dashboard.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('dashboard.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'title'=>'required',
            'image'=>'required|mimes:png,jpg',
            'body'=>'required',
            'price'=>'required',
            
        ]);
        $file=$request->file('image');
        if (!empty($file)) {
            $filename=time().$file->getClientOriginalName();
            $file->move('assets/images',$filename);
        }
        Product::create([
             'title'=>$request->title,
             'body'=>$request->body,
             'price'=>$request->price,
             'image'=>$filename,
             
       
        ]);
        return redirect(route('product.index'))->with('message','successfuly deleted');
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
        $product=Product::findOrfail($id);
        return view('dashboard.product.edit',compact('product'));
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
        $product=Product::findOrfail($id);
        $file=$request->file('image');
        $path='assets/images/'.$product->image;
        if (!empty($file)){
            if (file_exists($path)) {
                unlink($path);
                
            }
            $filename=time().$file->getClientOriginalName();
                $file->move('assets/images/',$filename);
        }else {
            $filename=$product->image;
        }
        $product->update([
            'title'=>$request->title,
             'body'=>$request->body,
             'price'=>$request->price,
             'image'=>$filename,
        ]);
        return redirect(route('product.index'))->with('message','updated');
    }
/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findOrfail($id);
        $path='assets/images/'.$product->image;
        if (!empty($path)) {
            unlink($path);
        }
        $product->delete();
        return redirect(route('product.index'))->with('message','deleted');
    }
  


    
}
