<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function cart()
    {
        return view('frontend.checkout.cart');
    }
}
