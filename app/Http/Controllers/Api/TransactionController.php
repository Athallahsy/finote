<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Resources\DataResource;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $data = Transaction::with('category')
            ->where('user_id', Auth::id())
            ->latest('tanggal')
            ->get();

        return new DataResource($data, 'success', 'get all transaction successfully');
    }

    public function store(StoreTransactionRequest $request)
    {
        $transaction = Transaction::create(array_merge(
            $request->validated(),
            ['user_id' => Auth::id()]
        ));

        $transaction->load('category');

        return new DataResource($transaction, 'success', 'create transaction successfully');
    }

    public function show(Transaction $transaction)
    {
        $this->authorizeTransaction($transaction);
        $transaction->load('category');

        return new DataResource($transaction, 'success', 'get detail transaction successfully');
    }

    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $this->authorizeTransaction($transaction);

        $transaction->update($request->validated());
        $transaction->load('category');

        return new DataResource($transaction, 'success', 'update transaction successfully');
    }

    public function destroy(Transaction $transaction)
    {
        $this->authorizeTransaction($transaction);
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
