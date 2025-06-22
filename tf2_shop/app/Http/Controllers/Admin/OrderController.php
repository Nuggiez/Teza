<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function complete(Order $order)
    {
        $order->status = 'completed';
        $order->save();
        return redirect()->route('admin.orders.index')->with('success', 'Order marked as completed.');
    }
}
