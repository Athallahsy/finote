<x-filament::widget>
    <x-filament::card class="bg-gray-900 text-white p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold">📋Recent Transactions</h2>
            <x-filament::badge color="primary">
                {{ count($this->getTransactions()) }} Records
            </x-filament::badge>
        </div>

        <div class="grid gap-4 max-h-80 overflow-y-auto">
            @forelse ($this->getTransactions() as $transaction)
                <div class="flex items-center justify-between bg-gray-800 p-4 rounded-lg shadow-md">
                    <div class="flex flex-col">
                        <span class="text-base font-semibold truncate">{{ $transaction->category->nama ?? 'Uncategorized' }}</span>
                        <span class="text-sm text-gray-400 truncate">{{ $transaction->judul }} - {{ $transaction->keterangan ?? 'No Description' }}</span>
                        <span class="text-xs text-gray-500">{{ $transaction->created_at->format('d M Y, H:i') }}</span>
                    </div>

                    {{-- Ini cara fix 100% --}}
                    <div class="text-right">
                        @if ($transaction->jenis == 'income')
                            <span class="text-lg font-bold" style="color: #4ade80;">
                                + Rp{{ number_format($transaction->jumlah, 0, ',', '.') }}
                            </span>
                        @else
                            <span class="text-lg font-bold" style="color: #f87171;">
                                - Rp{{ number_format($transaction->jumlah, 0, ',', '.') }}
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-10">
                    <h3 class="text-lg font-semibold">No Transactions Yet</h3>
                    <p class="text-gray-400 mt-2">Start by adding your first transaction!</p>
                    <x-filament::button wire:click="$emit('openCreateTransactionModal')" color="primary" class="mt-4">
                        Add Transaction
                    </x-filament::button>
                </div>
            @endforelse
        </div>

        <div class="mt-6 border-t border-gray-700 pt-4 text-sm text-gray-400">
            Showing {{ min(count($this->getTransactions()), 5) }} of {{ count($this->getTransactions()) }} transactions
        </div>
    </x-filament::card>
</x-filament::widget>
