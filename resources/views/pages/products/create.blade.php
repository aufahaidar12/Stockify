@extends('layouts.dashboard')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-semibold mb-6">Tambah Produk</h2>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nama Produk</label>
            <input type="text" name="name" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">SKU</label>
            <input type="text" name="sku" class="w-full border rounded p-2" required>
        </div>

        {{-- GANTI SELECT KATEGORI JADI INPUT BIASA --}}
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Kategori</label>
            <input type="text" name="category_name" class="w-full border rounded p-2" required>
        </div>

        {{-- GANTI SELECT SUPPLIER JADI INPUT BIASA --}}
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Supplier</label>
            <input type="text" name="supplier_name" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Harga Beli</label>
            <input type="number" name="purchase_price" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Harga Jual</label>
            <input type="number" name="selling_price" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Stok</label>
            <input type="number" name="minimum_stock" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Gambar</label>
            <input type="file" name="image" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Deskripsi</label>
            <textarea name="description" class="w-full border rounded p-2"></textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
