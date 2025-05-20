<?php

use App\Http\Controllers\DeliveryOrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('order',[DeliveryOrderController::class,'index']);
Route::post('order',[DeliveryOrderController::class,'store'])->name('order.store');
// route::get('orders-assign',function(){
//     Artisan::call('assign-orders');
//     return redirect('order')->with('Orders assigned successfully');
// });
