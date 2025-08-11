<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        // (tetap seperti implementasimu sebelumnya)
        $jumlahProduk = Product::count();
        $startDate = Carbon::now()->subDays(30);

        $transaksiMasuk = StockTransaction::where('type', 'Masuk')
            ->where('created_at', '>=', $startDate)
            ->count();

        $transaksiKeluar = StockTransaction::where('type', 'Keluar')
            ->where('created_at', '>=', $startDate)
            ->count();

        $grafikStok = Product::with(['transactions' => function ($q) {
                $q->select('product_id', 'type', 'quantity');
            }])->get()
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

        $aktivitasPengguna = User::orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        return view('pages.dashboard.admin', compact(
            'jumlahProduk',
            'transaksiMasuk',
            'transaksiKeluar',
            'grafikStok',
            'aktivitasPengguna'
        ));
    }

    public function manajer()
    {
        $today = Carbon::today();

        // Jika ada kolom stock di products, pakai langsung. Jika tidak, hitung dari transaksi.
        if (Schema::hasColumn('products', 'stock')) {
            $stokMenipis = Product::orderBy('stock', 'asc')
                ->take(5)
                ->get();
        } else {
            $stokMenipis = Product::with(['transactions' => function ($q) {
                    $q->select('product_id', 'type', 'quantity');
                }])->get()
                ->map(function ($product) {
                    $stok = $product->transactions
                        ->reduce(function ($carry, $trx) {
                            return $carry + ($trx->type === 'Masuk' ? $trx->quantity : -$trx->quantity);
                        }, 0);
                    // tambahkan attribute stock ke model sementara
                    $product->stock = $stok;
                    return $product;
                })
                ->sortBy('stock')
                ->take(5)
                ->values();
        }

        $barangMasukHariIni = StockTransaction::where('type', 'Masuk')
            ->whereDate('created_at', $today)
            ->sum('quantity');

        $barangKeluarHariIni = StockTransaction::where('type', 'Keluar')
            ->whereDate('created_at', $today)
            ->sum('quantity');

        return view('pages.dashboard.manajer', compact(
            'stokMenipis',
            'barangMasukHariIni',
            'barangKeluarHariIni'
        ));
    }
}
