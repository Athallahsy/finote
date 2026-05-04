<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $data = Transaction::where('user_id', Auth::id())->get();
        return new DataResource($data, 'success', 'get all transaction successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'jumlah'      => 'required|numeric',
            'judul'       => 'required',
<<<<<<< HEAD
            'jenis'       => 'required|in:income,expense',
=======
            'jenis'       => 'required|in:income,expanse',
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
            'keterangan'  => 'nullable',
            'tanggal'     => 'required|date',
        ]);

        $data = Transaction::create([
            'user_id'     => Auth::id(),
            'category_id' => $request->category_id,
            'judul'       => $request->judul,
            'jumlah'      => $request->jumlah,
            'tanggal'     => $request->tanggal,
            'jenis'       => $request->jenis,
            'keterangan'  => $request->keterangan,
        ]);

        return new DataResource($data, 'success', 'create transaction successfully');
    }

    public function show(Transaction $transaction)
    {
<<<<<<< HEAD
        $this->authorizeTransaction($transaction);
=======
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
        return new DataResource($transaction, 'success', 'get detail transaction successfully');
    }

    public function update(Request $request, Transaction $transaction)
    {
<<<<<<< HEAD
        $this->authorizeTransaction($transaction);

=======
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'jumlah'      => 'required|numeric',
            'judul'       => 'required',
<<<<<<< HEAD
            'jenis'       => 'required|in:income,expense',
=======
            'jenis'       => 'required|in:income,expanse',
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
            'keterangan'  => 'nullable',
            'tanggal'     => 'required|date',
        ]);

<<<<<<< HEAD
        $transaction->update($request->only([
            'category_id', 'jumlah', 'judul', 'jenis', 'keterangan', 'tanggal',
        ]));

=======
        $this->authorizeTransaction($transaction);
        $transaction->update($request->all());
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
        return new DataResource($transaction, 'success', 'update transaction successfully');
    }

    public function destroy(Transaction $transaction)
    {
        $this->authorizeTransaction($transaction);
<<<<<<< HEAD

=======
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
        $data = $transaction->delete();
        if (!$data) {
            return response()->json(['status' => 'failed', 'message' => 'failed delete transaction'], 500);
        }
        return response()->json(['status' => 'success', 'message' => 'delete transaction successfully'], 200);
    }

    private function authorizeTransaction(Transaction $transaction)
    {
        abort_if($transaction->user_id !== Auth::id(), 403, 'Unauthorized');
    }
}
