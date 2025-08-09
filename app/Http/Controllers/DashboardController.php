<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Jumlah produk
        $jumlahProduk = Product::count();

        // 2. Jumlah transaksi masuk & keluar (30 hari terakhir)
        $startDate = Carbon::now()->subDays(30);

        $transaksiMasuk = StockTransaction::where('type', 'Masuk')
            ->where('created_at', '>=', $startDate)
            ->count();

        $transaksiKeluar = StockTransaction::where('type', 'Keluar')
            ->where('created_at', '>=', $startDate)
            ->count();

        // 3. Data grafik stok barang
        // kalau kolom 'stock' di tabel products sudah dihapus, ini harus diganti dengan perhitungan dari transaksi
        $grafikStok = Product::with(['transactions' => function ($q) {
            $q->select('product_id', 'type', 'quantity');
        }])
        ->get()
        ->map(function ($product) {
            $stok = $product->transactions
                ->reduce(function ($carry, $trx) {
                    return $carry + ($trx->type === 'Masuk' ? $trx->quantity : -$trx->quantity);
                }, 0);
            return [
                'name' => $product->name,
                'stock' => $stok
            ];
        })
        ->sortBy('stock')
        ->take(5)
        ->values();
    

        // 4. Aktivitas pengguna terbaru
        $aktivitasPengguna = User::orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        return view('pages.practice.index', compact(
            'jumlahProduk',
            'transaksiMasuk',
            'transaksiKeluar',
            'grafikStok',
            'aktivitasPengguna'
        ));
    }
}
