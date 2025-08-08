@extends('layouts.dashboard')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Daftar Produk</h2>
        <a href="{{ route('products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Produk</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">SKU</th>
                    <th class="border px-4 py-2">Kategori</th>
                    <th class="border px-4 py-2">Supplier</th>
                    <th class="border px-4 py-2">Harga Beli</th>
                    <th class="border px-4 py-2">Harga Jual</th>
                    <th class="border px-4 py-2">Stok</th>
                    <th class="border px-4 py-2">Deskripsi</th>
                    <th class="border px-4 py-2">Gambar</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="text-center">
                        <td class="border px-4 py-2">{{ $product->name }}</td>
                        <td class="border px-4 py-2">{{ $product->sku }}</td>
                        <td class="border px-4 py-2">{{ $product->category->name ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $product->supplier->name ?? '-' }}</td>
                        <td class="border px-4 py-2">Rp{{ number_format($product->purchase_price) }}</td>
                        <td class="border px-4 py-2">Rp{{ number_format($product->selling_price) }}</td>
                        <td class="border px-4 py-2">{{ $product->stock }}</td>
                        <td class="border px-4 py-2">{{ $product->description ?? '-' }}</td>
                        <td class="border px-4 py-2">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="gambar" class="w-16 h-16 object-cover mx-auto">
                            @else
                                -
                            @endif
                        </td>
                        <td class="border px-4 py-2 space-x-2">
                            <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
