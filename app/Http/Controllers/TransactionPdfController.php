<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionPdfController extends Controller
{
    public function export(Request $request)
    {
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
    }
}
