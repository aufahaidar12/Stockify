@extends('layouts.dashboard')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
         Laporan Stok Barang
    </h2>

    {{-- Tabel Laporan --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full border border-gray-200 rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-gray-700 text-left">
                    <th class="p-3 border-b">Nama Produk</th>
                    <th class="p-3 border-b">Stok</th>
                    <th class="p-3 border-b">Stok Minimum</th>
                    <th class="p-3 border-b">Harga</th>
                    <th class="p-3 border-b">Terakhir Update</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 border-b font-medium">{{ $product->name }}</td>
                        
                        {{-- Stok dengan warna sesuai kondisi --}}
                        <td class="p-3 border-b {{ $product->stock < $product->minimum_stock ? 'text-red-600 font-bold' : 'text-gray-800' }}">
                            {{ $product->stock }}
                        </td>
                        
                        <td class="p-3 border-b">{{ $product->minimum_stock }}</td>
                        <td class="p-3 border-b">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="p-3 border-b">{{ $product->updated_at->format('d-m-Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada data produk</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Tombol Export --}}
    <div class="mt-6 flex gap-4">
        <a href="#" 
           class="bg-red-500 text-white px-5 py-2 rounded-lg hover:bg-red-600 shadow flex items-center gap-2">
             Export PDF
        </a>
        <a href="#" 
           class="bg-green-500 text-white px-5 py-2 rounded-lg hover:bg-green-600 shadow flex items-center gap-2">
             Export Excel
        </a>
    </div>
</div>
@endsection
