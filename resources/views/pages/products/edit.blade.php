@extends('layouts.dashboard')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-semibold mb-6">Edit Produk</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nama Produk</label>
            <input type="text" name="name" class="w-full border rounded p-2" value="{{ $product->name }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">SKU</label>
            <input type="text" name="sku" class="w-full border rounded p-2" value="{{ $product->sku }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Kategori</label>
            <select name="category_id" class="w-full border rounded p-2" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected($product->category_id == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Supplier</label>
            <select name="supplier_id" class="w-full border rounded p-2" required>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" @selected($product->supplier_id == $supplier->id)>{{ $supplier->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Harga Beli</label>
            <input type="number" name="purchase_price" class="w-full border rounded p-2" value="{{ $product->purchase_price }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Harga Jual</label>
            <input type="number" name="selling_price" class="w-full border rounded p-2" value="{{ $product->selling_price }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Stok</label>
            <input type="number" name="stock" class="w-full border rounded p-2" value="{{ $product->stock }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Gambar</label>
            <input type="file" name="image" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Deskripsi</label>
            <textarea name="description" class="w-full border rounded p-2">{{ $product->description }}</textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
