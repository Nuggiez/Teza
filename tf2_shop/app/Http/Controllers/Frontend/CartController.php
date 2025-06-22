<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Product $product)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to add items to your cart.');
        }

        $user = Auth::user();

        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            return back()->with('info', 'This item is already in your cart.');
        }

        Cart::create([
            'user_id' => $user->id,
            'product_id' => $product->id
        ]);

        return back()->with('success', 'Item added to cart successfully!');
    }

    public function remove(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            return back()->with('error', 'You do not have permission to remove this item.');
        }

        $cart->delete();

        return back()->with('success', 'Item removed from cart successfully!');
    }
}
