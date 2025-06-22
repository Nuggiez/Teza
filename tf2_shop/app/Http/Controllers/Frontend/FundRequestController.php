<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FundRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FundRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $user = Auth::user();
        FundRequest::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        // Redirect to PayPal.me with the amount
        $paypalUrl = 'https://www.paypal.com/paypalme/urmomisah0e/' . $request->amount;

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['paypal_url' => $paypalUrl]);
        }

        return redirect()->away($paypalUrl);
    }
}
