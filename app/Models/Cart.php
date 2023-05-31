<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    
    public $products=[];
    public $price=0;
    public $count=0;
    public $address=null;
    
    public function __construct ($cart = null)
    {
        if (!is_null($cart)) {
            
            $this->products=$cart->products;
            $this->count=$cart->count;
            $this->price=$cart->price;
            $this->address=$cart->address;
        }
    }
    public function addcart($product)
    {
        
        if (array_key_exists($product->id , $this->products)) {
            $this->products[$product->id]=[
                'product'=>$product,
                'count'=>$this->products[$product->id]['count']+1
            ];
        } else {
        $this->products[$product->id]=[
            'product'=>$product,
            'count'=>1
        ];
    }
        $this->price+=$product->price;
        $this->count+=1;
    
    
}
public function updatecart($product,$qty)
{
    $oldcount=$this->products[$product->id]['count'];
    $this->products[$product->id]=[
        'product'=>$product,
        'count'=>$qty
    ];
    $newcount=$this->products[$product->id]['count'];
    $count=$newcount-$oldcount;
    $this->count+=$count;
    $this->price+=$count * $product->price;

}
public function removecart($product)
{
   
    $count=$this->products[$product->id]['count'];
    $this->count-=$count;
    $this->price-=$count * $product->price;
    unset($this->products[$product->id]);
}
public function addaddress($address)
{
    $this->address=$address; 
    return redirect(route('invoice')); 
}

}
