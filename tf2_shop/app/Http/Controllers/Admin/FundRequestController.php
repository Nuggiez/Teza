<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FundRequest;
use App\Models\User;
use Illuminate\Http\Request;

class FundRequestController extends Controller
{
    public function index()
    {
        $fundRequests = FundRequest::with('user')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.fund_requests.index', compact('fundRequests'));
    }

    public function complete(FundRequest $fund_request)
    {
        if ($fund_request->status !== 'pending') {
            return redirect()->route('admin.fund_requests.index')->with('error', 'Request already processed.');
        }
        $fund_request->status = 'completed';
        $fund_request->save();
        // Credit the user's funds
        $user = $fund_request->user;
        $user->funds += $fund_request->amount;
        $user->save();
        return redirect()->route('admin.fund_requests.index')->with('success', 'Fund request marked as completed and funds credited.');
    }

    public function reject(FundRequest $fund_request)
    {
        if ($fund_request->status !== 'pending') {
            return redirect()->route('admin.fund_requests.index')->with('error', 'Request already processed.');
        }
        $fund_request->status = 'rejected';
        $fund_request->save();
        return redirect()->route('admin.fund_requests.index')->with('success', 'Fund request rejected.');
    }
}
