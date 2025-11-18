<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreTransactionRequest;
use Illuminate\Support\Facades\Auth;
use App\Events\TransactionCreated;
use App\Events\TransactionUpdated;
use App\Events\TransactionDeleted;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Auth::user()->transactions()->latest('transaction_date')->paginate(15);
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Auth::user()->categories()->get();
        return view('transactions.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        $transaction = Auth::user()->transactions()->create($request->validated());
        event(new TransactionCreated($transaction));
        return redirect()->route('transactions.index')->with('success','Transacción registrada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $this->authorize('update',$transaction);
        $categories = Auth::user()->categories()->get();
        return view('transactions.edit', compact('transaction','catagories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTransactionRequest $request, Transaction $transaction)
    {
        $this->authorize('update' ,$transaction);
        $transaction->update($request->validated());
        event(new TransactionUpdated($transaction));
        return redirect()->route('transactions.index')->with('success','Transaccion actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $this->authorize('delete' ,$transaction);
        $transactionData = $transaction->toArray();
        $user = $transaction->user;
        $transaction->delete();
        event(new TransactionDeleted(new Transaction($transactionData),$user));
        return redirect()->route('transactions.index')->with('success','Transaccion eliminada exitosamente');


    }
}
