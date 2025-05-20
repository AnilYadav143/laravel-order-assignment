<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class DeliveryOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('deliveryAssignments.deliveryBoy')->get();
        return view('index', compact('orders'));
    }
    public function store(Request $request)
    {
        Order::create([
            'number_order' => 'ORD'.str_pad(Order::count() + 1, 4, '0', ),
        ]);
        return redirect('order')->with('success', 'Order created successfully');
    }
}
