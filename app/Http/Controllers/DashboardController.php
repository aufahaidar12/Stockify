<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        $startDate = Carbon::now()->subDays(30);

        // Data umum yang bisa diakses oleh admin & manajer
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

        $transaksiMasuk = StockTransaction::where('type', 'Masuk')
            ->where('created_at', '>=', $startDate)
            ->count();

        $transaksiKeluar = StockTransaction::where('type', 'Keluar')
            ->where('created_at', '>=', $startDate)
            ->count();

        // Data khusus admin
        $jumlahProduk = null;
        $aktivitasPengguna = collect();

        if ($role === 'admin') {
            $jumlahProduk = Product::count();

            $aktivitasPengguna = User::orderBy('updated_at', 'desc')
                ->take(5)
                ->get();
        }

        return view('pages.dashboard.admin', compact(
            'jumlahProduk',
            'transaksiMasuk',
            'transaksiKeluar',
            'grafikStok',
            'aktivitasPengguna',
            'role'
        ));
    }
}
