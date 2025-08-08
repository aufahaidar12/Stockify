<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockTransaction;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;

class ReportController extends Controller
{
    public function index()
    {
        return view('pages.reports.index');
    }

    public function transactions(Request $request)
    {
        $transactions = StockTransaction::with(['product', 'user'])
            ->when($request->start_date && $request->end_date, function($query) use ($request) {
                $query->whereBetween('date', [$request->start_date, $request->end_date]);
            })
            ->get();

        return view('pages.reports.transactions', compact('transactions'));
    }

    public function stocks()
    {
        $products = Product::with('stockTransactions')->get();

        // Hitung stok berdasarkan transaksi
        $products = $products->map(function ($product) {
            $stokMasuk = $product->stockTransactions()
                ->where('type', 'Masuk')
                ->where('status', 'Diterima')
                ->sum('quantity');

            $stokKeluar = $product->stockTransactions()
                ->where('type', 'Keluar')
                ->where('status', 'Dikeluarkan')
                ->sum('quantity');

            $product->final_stock = $product->minimum_stock + $stokMasuk - $stokKeluar;
            return $product;
        });

        return view('pages.reports.stocks', compact('products'));
    }

    public function exportPDF()
    {
        $products = Product::with('stockTransactions')->get();

        $products = $products->map(function ($product) {
            $stokMasuk = $product->stockTransactions()
                ->where('type', 'Masuk')
                ->where('status', 'Diterima')
                ->sum('quantity');

            $stokKeluar = $product->stockTransactions()
                ->where('type', 'Keluar')
                ->where('status', 'Dikeluarkan')
                ->sum('quantity');

            $product->final_stock = $product->minimum_stock + $stokMasuk - $stokKeluar;
            return $product;
        });

        $pdf = PDF::loadView('pages.reports.pdf.stocks', compact('products'));
        return $pdf->download('laporan-stok.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new ProductsExport, 'laporan-stok.xlsx');
    }
}
