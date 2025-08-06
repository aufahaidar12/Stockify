<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockTransaction;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class StockTransactionController extends Controller
{
    public function index()
    {
        $transactions = StockTransaction::with(['product','user'])->latest()->get();
        return view('pages.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::all();
        return view('pages.transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:Masuk,Keluar',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:Pending,Diterima,Ditolak,Dikeluarkan',
            'notes' => 'nullable|string'
        ]);

        $validated['user_id'] = Auth::id();
        $validated['date'] = now();

        $transaction = StockTransaction::create($validated);
        // Update stok produk jika status Diterima atau Dikeluarkan
        $product = Product::find($validated['product_id']);
        if($validated['status'] == 'Diterima' && $validated['type'] == 'Masuk') {
            $product->increment('stock', $validated['quantity']);
        } elseif($validated['status'] == 'Dikeluarkan' && $validated['type'] == 'Keluar') {
            $product->decrement('stock', $validated['quantity']);
        }

        return redirect()->route('transactions.index')->with('success','Transaksi berhasil disimpan');
    }
}
