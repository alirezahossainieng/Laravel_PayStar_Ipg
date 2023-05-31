<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Authcontroller extends Controller
{
    public function registerview(Request $request)
    {   
        $cart=$request->session()->has('cart') ? $request->session()->get('cart') : null;

        return view('website.Auth.register',compact('cart'));
    }
    public function registersubmit(Request $request)
    {
        $validatedata=$request->validate([
            'name'=>'required|min:2',
            'email'=>'required|min:2',
            'password'=>'required',
        ]);
        if ($validatedata) {
            $user=User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);
            Auth::login($user);
            return redirect(route('index.product'));
        }
    }
    public function loginview(Request $request)
    {
        $cart=$request->session()->has('cart') ? $request->session()->get('cart') : null;

        return view('website.Auth.login',compact('cart'));
    }
    public function loginsubmit(Request $request)
    {
        
        $validatedata=$request->validate([
            'name'=>'required|min:2',
            'email'=>'required|min:2',
            'password'=>'required',
        ]);
        $user=User::where('email',$request->email)->first();
        if (!is_null($user)) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect(route('index.product'));
            }else {
                return redirect()->back()->with('message','not regesterd')->withInput();
            }
        }else {
            return redirect()->back()->with('message','user or pass is wrong')->withInput();
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect(route('index.product'));
    }
}
