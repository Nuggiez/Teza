<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ClaimRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClaimRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $user = Auth::user();
        $amount = floatval($request->amount);
        if ($amount > $user->funds) {
            return response()->json(['message' => 'You cannot claim more than your available funds.'], 422);
        }

        ClaimRequest::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Claim request submitted!']);
    }
}
