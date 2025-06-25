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
        if ($order->status !== 'pending') {
            return redirect()->route('admin.orders.index')->with('error', 'Order already processed.');
        }
        $order->status = 'completed';
        $order->save();
        // Distribute funds to sellers
        foreach ($order->items as $item) {
            $product = $item->product;
            if ($product && $product->user) {
                $seller = $product->user;
                $seller->funds += $item->price;
                $seller->save();
            }
        }
        // Remove products from the order
        foreach ($order->items as $item) {
            $product = $item->product;
            if ($product) {
                $path = public_path('uploads/product/' . $product->image);
                if (file_exists($path)) {
                    @unlink($path);
                }
                $product->delete();
            }
        }
        return redirect()->route('admin.orders.index')->with('success', 'Order marked as completed. Sellers have been paid.');
    }
}
