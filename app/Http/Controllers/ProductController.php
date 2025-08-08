<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Tampilkan daftar produk
     */
    public function index()
    {
        $products = Product::with(['category', 'supplier'])->latest()->paginate(10);
        return view('pages.products.index', compact('products'));
    }

    /**
     * Form tambah produk
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('pages.products.create', compact('categories', 'suppliers'));
    }

    /**
     * Simpan produk baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'      => 'required|exists:categories,id',
            'supplier_id'      => 'required|exists:suppliers,id',
            'name'             => 'required|string|max:255',
            'sku'              => 'nullable|string|max:100',
            'description'      => 'nullable|string',
            'purchase_price'   => 'required|numeric|min:0',
            'selling_price'    => 'required|numeric|min:0',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'minimum_stock'    => 'required|integer|min:0',
        ]);
      
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Form edit produk
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('pages.products.edit', compact('product', 'categories', 'suppliers'));
    }

    /**
     * Update produk
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id'      => 'required|exists:categories,id',
            'supplier_id'      => 'required|exists:suppliers,id',
            'name'             => 'required|string|max:255',
            'sku'              => 'nullable|string|max:100',
            'description'      => 'nullable|string',
            'purchase_price'   => 'required|numeric|min:0',
            'selling_price'    => 'required|numeric|min:0',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'minimum_stock'    => 'required|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Hapus produk
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
