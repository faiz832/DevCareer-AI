<?php

namespace App\Http\Controllers;

use App\Models\SubscribeTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        DB::transaction(function () use ($request, $subscribeTransaction){

            $oldAttributes = $subscribeTransaction->getAttributes();

            $subscribeTransaction->update([
                'is_paid' => true,
                'subscription_start_date' => Carbon::now()
            ]);

            activity()
                ->causedBy(Auth::user())
                ->performedOn($subscribeTransaction)
                ->withProperties([
                    'old' => $oldAttributes,
                    'attributes' => $subscribeTransaction->getAttributes()
                ])
                ->log('Subscription transaction approved: ' . $subscribeTransaction->id);
        });

        return redirect()->route('admin.subscribe_transactions.show', ['subscribe_transaction' => $subscribeTransaction])
                ->with('success', 'Transaction approved successfully. Subscription starts from now.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscribeTransaction $subscribeTransaction)
    {
        DB::beginTransaction();

        try {
            $oldAttributes = $subscribeTransaction->getAttributes();

            $subscribeTransaction->delete();

            activity()
                ->causedBy(Auth::user())
                ->performedOn($subscribeTransaction)
                ->withProperties(['old' => $oldAttributes])
                ->log('Subscription transaction deleted: ' . $subscribeTransaction->id);

            DB::commit();

            return redirect()->route('admin.subscribe_transactions.index')->with('success', 'Transaction deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.subscribe_transactions.index')->with('error', 'An error occurred while deleting the transaction.');
        }
    }
}
