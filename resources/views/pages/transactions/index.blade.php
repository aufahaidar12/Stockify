@extends('layouts.dashboard')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
         Daftar Transaksi Stok
    </h2>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-5 shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tombol Tambah Transaksi --}}
    <div class="flex justify-between mb-4">
        <a href="{{ route('transactions.create') }}" 
           class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700">
           + Tambah Transaksi
        </a>
    </div>

    {{-- Tabel Transaksi --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full border border-gray-300 rounded-lg">
            <thead>
                <tr class="bg-gray-100 border-b text-gray-700 text-sm uppercase">
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Produk</th>
                    <th class="px-4 py-3 text-left">Jenis</th>
                    <th class="px-4 py-3 text-left">Jumlah</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                    <th class="px-4 py-3 text-left">Catatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 text-sm">{{ $transaction->product->name ?? '-' }}</td>
                        
                        {{-- Jenis Transaksi dengan warna --}}
                        <td class="px-4 py-3 text-sm">
                            <span class="{{ $transaction->type == 'Masuk' ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' }}">
                                {{ $transaction->type }}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-sm">{{ $transaction->quantity }}</td>
                        
                        {{-- Status dengan badge --}}
                        <td class="px-4 py-3 text-sm">
                            @php
                                $statusColors = [
                                    'Pending' => 'bg-yellow-100 text-yellow-700',
                                    'Diterima' => 'bg-green-100 text-green-700',
                                    'Ditolak' => 'bg-red-100 text-red-700',
                                    'Dikeluarkan' => 'bg-blue-100 text-blue-700'
                                ];
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusColors[$transaction->status] ?? 'bg-gray-100 text-gray-700' }}">
                                {{ $transaction->status }}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($transaction->date)->format('d-m-Y') }}</td>
                        <td class="px-4 py-3 text-sm">{{ $transaction->notes ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-6 text-gray-500">
                            Belum ada transaksi
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
