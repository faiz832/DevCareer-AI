<?php

namespace App\Http\Controllers;

use App\Models\SubscribeTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SubscribeTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = SubscribeTransaction::with(['user'])->orderByDesc('id')->get();

        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SubscribeTransaction $subscribeTransaction)
    {
        return view('admin.transactions.show', ['transaction' => $subscribeTransaction]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubscribeTransaction $subscribeTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubscribeTransaction $subscribeTransaction)
    {
        if ($subscribeTransaction->is_paid) {
            // If currently paid, change to unpaid
            $subscribeTransaction->update([
                'is_paid' => false,
                'subscription_start_date' => null,
            ]);
            $message = 'Transaction unapproved successfully.';
        } else {
            // If currently unpaid, change to paid
            $subscribeTransaction->update([
                'is_paid' => true,
                'subscription_start_date' => Carbon::now(),
            ]);
            $message = 'Transaction approved successfully. Subscription starts from now.';
        }

        return redirect()->route('admin.subscribe_transactions.show', $subscribeTransaction)
            ->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscribeTransaction $subscribeTransaction)
    {
        //
    }
}
