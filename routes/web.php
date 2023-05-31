<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;

use App\Http\Controllers\Ordercontroller;
use App\Http\Controllers\productcontroller;
use App\Http\Controllers\websitecontroller;
use App\Http\Controllers\Admin\Manageproductcontroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [productcontroller::class,'index'])->name('index.product');
Route::post('/callback', [Ordercontroller::class,'callback'])->name('callback');
Route::get('/success', [Ordercontroller::class,'success'])->name('success');
Route::get('/fail', [Ordercontroller::class,'fail'])->name('fail');
Route::get('/web', [websitecontroller::class,'index']);
Route::post('/addproduct/{product}', [Ordercontroller::class,'add'])->name('addproduct');
Route::get('/showcart', [Ordercontroller::class,'show'])->name('showcart');
Route::put('/updatecart/{product}', [Ordercontroller::class,'update'])->name('updatecart');
Route::post('/invoice', [Ordercontroller::class,'invoice'])->middleware('auth')->name('invoice');
Route::get('/showinvoice', [Ordercontroller::class,'showinvoice'])->name('showinvoice');
Route::get('/order/store', [Ordercontroller::class,'store'])->name('orderstore');
Route::match(['get', 'post'], '/pay-result',[Ordercontroller::class,'payresult'])->name('payresult');
Route::get('/logout', [Authcontroller::class,'logout'])->name('logout');
Route::get('/{id}', [productcontroller::class,'showproduct'])->name('show.product');
Route::delete('/removecart/{product}', [Ordercontroller::class,'remove'])->name('removecart');

Route::prefix('admin')->group(function () {
    Route::resource('/product', Manageproductcontroller::class);
    //  route::resource('/product',Manageroductcontroller::class);
});
Route::middleware('guest')->prefix('auth')->group(function () {
    Route::get('/register', [Authcontroller::class,'registerview'])->name('register');
    Route::get('/login', [Authcontroller::class,'loginview'])->name('login');
    Route::post('/registersubmit', [Authcontroller::class,'registersubmit'])->name('registersubmit');
    Route::post('/loginsubmit', [Authcontroller::class,'loginsubmit'])->name('loginsubmit');
});
