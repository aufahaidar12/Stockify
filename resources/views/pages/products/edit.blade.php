@extends('layouts.dashboard')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
         Edit Produk
    </h2>

    {{-- Notifikasi Error --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-5 shadow">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Edit Produk --}}
    <div class="bg-white rounded-lg shadow p-6 max-w-lg">
        <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Nama Produk --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-700">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    placeholder="Masukkan nama produk" required>
            </div>

            {{-- Stok --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-700">Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    min="0" placeholder="Masukkan jumlah stok" required>
            </div>

            {{-- Stok Minimum --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-700">Stok Minimum</label>
                <input type="number" name="minimum_stock" value="{{ old('minimum_stock', $product->minimum_stock) }}" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    min="0" placeholder="Minimal stok untuk status aman" required>
            </div>

            {{-- Harga --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-700">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    min="0" placeholder="Masukkan harga produk" required>
            </div>

            {{-- Tombol --}}
            <div class="flex items-center gap-4">
                <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow">
                    Update
                </button>
                <a href="{{ route('products.index') }}" 
                   class="text-gray-600 hover:text-gray-800 underline">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
