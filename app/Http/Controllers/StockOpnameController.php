<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class StockOpnameController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('pages.opname.index', compact('products'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.stock' => 'required|integer|min:0'
        ]);

        foreach ($validated['products'] as $productData) {
            $product = Product::find($productData['id']);
            $product->update(['stock' => $productData['stock']]);
        }

        return redirect()->route('opname.index')->with('success', 'Stock opname berhasil disimpan.');
    }
}
