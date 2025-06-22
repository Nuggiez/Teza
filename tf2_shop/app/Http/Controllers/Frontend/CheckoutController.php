<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function cart()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your cart.');
        }

        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('frontend.checkout.cart', compact('cartItems'));
    }

    public function checkout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to checkout.');
        }

        $user = Auth::user();
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price);

        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_price' => $total,
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'price' => $item->product->price,
            ]);
        }

        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('cart')->with('success', 'Order placed successfully!');
    }
}
