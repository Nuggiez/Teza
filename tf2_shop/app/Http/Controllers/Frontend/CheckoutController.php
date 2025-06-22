<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
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
}
