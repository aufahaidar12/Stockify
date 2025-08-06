<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockTransaction;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        return view('pages.reports.index');
    }

    public function transactions(Request $request)
    {
        $transactions = StockTransaction::with(['product','user'])
            ->when($request->start_date && $request->end_date, function($query) use ($request) {
                $query->whereBetween('date', [$request->start_date, $request->end_date]);
            })
            ->get();

        return view('pages.reports.transactions', compact('transactions'));
    }

    public function stocks()
    {
        $products = Product::all();
        return view('pages.reports.stocks', compact('products'));
    }

    public function exportPDF()
    {
        $products = Product::all();
        $pdf = PDF::loadView('pages.reports.pdf.stocks', compact('products'));
        return $pdf->download('laporan-stok.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new ProductsExport, 'laporan-stok.xlsx');
    }
}
