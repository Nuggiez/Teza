<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClaimRequest;
use Illuminate\Http\Request;

class ClaimRequestController extends Controller
{
    public function index()
    {
        $claimRequests = ClaimRequest::with('user')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.claim_requests.index', compact('claimRequests'));
    }

    public function complete(ClaimRequest $claim_request)
    {
        if ($claim_request->status !== 'pending') {
            return redirect()->route('admin.claim_requests.index')->with('error', 'Request already processed.');
        }
        $claim_request->status = 'completed';
        $claim_request->save();
        // Deduct the user's funds
        $user = $claim_request->user;
        $user->funds -= $claim_request->amount;
        $user->save();
        return redirect()->route('admin.claim_requests.index')->with('success', 'Claim request marked as completed and funds deducted.');
    }

    public function reject(ClaimRequest $claim_request)
    {
        if ($claim_request->status !== 'pending') {
            return redirect()->route('admin.claim_requests.index')->with('error', 'Request already processed.');
        }
        $claim_request->status = 'rejected';
        $claim_request->save();
        return redirect()->route('admin.claim_requests.index')->with('success', 'Claim request rejected.');
    }
}
