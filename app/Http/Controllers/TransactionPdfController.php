<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionPdfController extends Controller
{
    public function export(Request $request)
    {
        // 1. Ambil filter tanggal jika ada
        $start = $request->input('startDate');
        $end   = $request->input('endDate');

        // 2. Query data transaksi
        $query = Transaction::with('category')->latest();
        if ($start && $end) {
            $query->whereBetween('created_at', [
                $start.' 00:00:00',
                $end.' 23:59:59',
            ]);
        }
        $transactions = $query->get();

        // 3. Load view & generate PDF
        $pdf = Pdf::loadView('pdf.transactions', compact('transactions', 'start', 'end'))
                  ->setPaper('a4', 'landscape');

        // 4. Stream ke browser
        return $pdf->stream("transactions_{$start}_to_{$end}.pdf");
    }
}
