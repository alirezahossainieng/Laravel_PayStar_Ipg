<?php

namespace App\Http\Controllers;

use App\Models\Cart;
// use payping\src\Payment;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
// use Shetabit\Payment\Facade\Payment;
use Shetabit\Multipay\Invoice;
use Illuminate\Support\Facades\Auth;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;


class Ordercontroller extends Controller
{
    public function fail()
    {
        return view('website.payment.failpayment');
    }

    public function callback(Request $request)
    {

        $order=Order::find($request->order_id);
                 $order->update([
                                 "ref_id" => $request->tracking_code
                          ]);
        #amount#ref_num#card_number#tracking_code
        $sign=$order->price.'#'.$request->ref_num.'#'.$request->card_number.'#'.$request->tracking_code;

        $token = "0yovdk2l6e143";

        $payment = new \PayPing\Payment($token);
        try {
            if($payment->verify($request->ref_num,$order->price,$sign,$request->order_id)){
                return view('website.payment.successpayment',compact('order'));
            }else{
                return $this->fail();
            }
        }
        catch (paypingException $e) {
            foreach (json_decode($e->getMessage(), true) as $msg) {
                echo $msg;
            }
       }

        // if ($request->status=='-98') {
        //    echo 'تراکنش ناموفق';
        // }elseif ($request->status=='1') {
        //     echo 'تراکنش موفق';
        // }

    }
    public function add(Product $product,Request $request)
    {   
        $price=new Cart;
        // dd($price->price);
         $oldcart=$request->session()->has('cart') ? $request->session()->get('cart') : null;
         $cart=new Cart($oldcart);

         $cart->addcart($product);

         $request->session()->put('cart', $cart);
         return redirect(route('index.product'));
    }
    public function show(Request $request)
    {
        $oldcart=$request->session()->has('cart') ? $request->session()->get('cart') : null;
         $cart=new Cart($oldcart);

         return view('website.cart.showcart',compact('cart'));



    }
    public function update(Product  $product,Request $request)
    {
        $oldcart=$request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart=new Cart($oldcart);
        $qty=$request->qty;
        if ($qty<1 or $qty>10 ) {
            return redirect()->back()->with('message','select number between 1 to 10');
        }
        $cart->updatecart($product,$qty);
        $request->session()->put('cart', $cart);
        return redirect(route('showcart'));
    }
    public function remove(Product  $product,Request $request)
    {
        $oldcart=$request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart=new Cart($oldcart);
        $cart->removecart($product);
        $request->session()->put('cart', $cart);
        return redirect(route('showcart'));
    }
    public function invoice(Request $request)
    {
        $oldcart=$request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart=new Cart($oldcart);
        $cart->addaddress($request->address);
        // $cart->adddiscount($request->discount);
        $request->session()->put('cart', $cart);
        return redirect(route('showinvoice'));
    }
    public function showinvoice(Request $request)
    {
        $cart=$request->session()->has('cart') ? $request->session()->get('cart') : null;
        return view('website.cart.invoice',compact('cart'));
    }
    public function store(Request $request)
    {

        $oldCart = $request->session()->has("cart") ? $request->session()->get("cart") : null;
        $cart = new Cart($oldCart);
        //========
        $order = auth()->user()->orders()->create([
            "price" => $cart->price ,
            "address" => $cart->address ,
        ]);


        foreach($cart->products as $item)
        {
            $product = $item['product'];
            $order->products()->attach ([
                $product->id => [
                    "count" => $item['count'] ,
                    "price" => $product->price ,
                ]
            ]);
        }

    //     $invoice = new Invoice;
    //     $invoice->amount($order->price);
    //     return Payment::callbackUrl(route("payResult"))->purchase(
    //         $invoice,
    //         function($driver, $transactionId) use($order) {
    //             $order->update([
    //                 "t_id" => $transactionId
    //             ]);
    //         }
    //     )->pay()->render();;

    // }

    // public function payResult(Request $request){
    //     $transaction_id = $request->Authority;
    //     $order = Order::where("t_id" , $transaction_id)->first();
    //     if (is_null($order))
    //         abort(404);
    //     try {
    //         $receipt = Payment::amount($order->price)->transactionId($transaction_id)->verify();
    //         $order->update([
    //             "ref_id" => $receipt->getReferenceId() ,
    //             "status" => "payed"
    //         ]);
    //         $request->session()->remove("cart");
    //         dd("merc k kharid kardi");
    //     } catch (InvalidPaymentException $exception) {
    //         dd($exception->getMessage());
    //     }
    $token='0yovdk2l6e143';
    $sign=$order->price.'#'.$order->id.'#'.'http://127.0.0.1:8000/callback';
    // dd($request->all());
    $args = [
        "amount" => $order->price,
        "order_id" => $order->id,
        "card_number" => '6037998208579119',
        "callback" => route('callback'),
         "sign" => hash_hmac('sha512',$sign,'9A3EC03483556C73714510C507529DF70A1228C83477D1455E0511BD72C5AAB8A6715A414AA48B7C905FCEF45868BD26DA58196EF29C77C194C9F14A4B47456CC6454E9D50B388D6FC5AC91BB08B234A8060FDC85B1CEC32CA036DC907F8A4A635D9CBB9CAA31B42549B8D70B2CE5EDE8274FFB55DABFE92D76BC42D91696FAF'),
        // "sign" => '94f5aedfe4f453c0ca9a3ef9352918cdb7b1d41b6e8397f3ac19bca78bc58a4257f91750e4d2f73d648215f802c9ba1c0bcf2e222f26abdeb0eb7448995b9e21',

    ];

    $payment = new \PayPing\Payment($token);

    try {
        $payment->pay($args);
    } catch (Exception $e) {
        var_dump($e->getMessage());
    }
    //echo $payment->getPayUrl();
    return redirect($payment->getPayUrl());



    // $oldcart=$request->session()->forget('cart');
    $cart=new Cart($oldcart);

    return redirect('http://127.0.0.1:8000/');
}
// public function orderlist(Request $request)
//     {
//         $orderlist=Order::all();

//         // foreach ($orderlist->products as $value) {
//         //     dd($value->pivot->price);
//         // }

//         return view('dashboard.orders',compact('orderlist'));

//     }
}
