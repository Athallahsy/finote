<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        return Transaction::where('user_id', Auth::id())->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'       => 'required',
            'jumlah'      => 'required|numeric',
            'tanggal'     => 'required|date',
            'jenis'       => 'required|in:income,outcome',
            'category_id' => 'required|exists:categories,id',
            'keterangan'  => 'nullable',
        ]);

        return Transaction::create([
            'judul'       => $request->judul,
            'jumlah'      => $request->jumlah,
            'tanggal'     => $request->tanggal,
            'jenis'       => $request->jenis,
            'category_id' => $request->category_id,
            'user_id'     => Auth::id(),
            'keterangan'  => $request->keterangan,
        ]);
    }

    public function show(Transaction $transaction)
    {
        return $transaction;
    }

    public function update(Request $request, Transaction $transaction)
    {
        $this->authorizeTransaction($transaction);
        $transaction->update($request->all());
        return $transaction;
    }

    public function destroy(Transaction $transaction)
    {
        $this->authorizeTransaction($transaction);
        $transaction->delete();
        return response()->noContent();
    }

    private function authorizeTransaction(Transaction $transaction)
    {
        abort_if($transaction->user_id !== Auth::id(), 403, 'Unauthorized');
    }
}

