<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
=======
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionPdfController extends Controller
{
    public function export(Request $request)
    {
<<<<<<< HEAD
        $start = $request->input('startDate');
        $end   = $request->input('endDate');

        // CRITICAL: only export transactions belonging to the authenticated user.
        $query = Transaction::with('category')
            ->where('user_id', Auth::id())
            ->orderByDesc('tanggal');

        if ($start && $end) {
            // Use semantic 'tanggal' column, not created_at.
            $query->whereBetween('tanggal', [$start, $end]);
        }

        $transactions = $query->get();

        $records = $transactions->map(function ($item) {
            return [
                'judul'      => $item->judul,
                'tanggal'    => optional($item->tanggal)->format('d F Y') ?? '-',
                'jumlah'     => 'Rp' . number_format($item->jumlah, 0, ',', '.'),
                'jenis'      => $item->jenis === 'income' ? 'Pemasukan' : 'Pengeluaran',
                'kategori'   => optional($item->category)->nama ?? '-',
                'keterangan' => $item->keterangan ?? '',
            ];
        });

        $pdf = Pdf::loadView('pdf.transactions', [
                    'records' => $records,
                    'start'   => $start,
                    'end'     => $end,
                ])
                ->setPaper('a4', 'landscape');

        $filename = 'transactions_' . ($start ?: 'all') . '_to_' . ($end ?: 'all') . '.pdf';

        return $pdf->stream($filename);
=======
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
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
    }
}
