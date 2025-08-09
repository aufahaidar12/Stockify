<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StockTransaction;
use App\Models\Product;
use App\Models\User;

class StockTransactionSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        $users = User::all();

        if ($products->isEmpty() || $users->isEmpty()) {
            $this->command->warn('Produk atau User belum ada, seeder transaksi dilewati.');
            return;
        }

        foreach ($products as $product) {
            // Transaksi Masuk
            StockTransaction::create([
                'product_id' => $product->id,
                'user_id' => $users->random()->id,
                'type' => 'Masuk',
                'quantity' => rand(10, 50),
                'date' => now()->subDays(rand(5, 20)),
                'status' => 'Diterima',
                'notes' => 'Stok awal masuk'
            ]);

            // Transaksi Keluar
            StockTransaction::create([
                'product_id' => $product->id,
                'user_id' => $users->random()->id,
                'type' => 'Keluar',
                'quantity' => rand(1, 10),
                'date' => now()->subDays(rand(1, 5)),
                'status' => 'Dikeluarkan',
                'notes' => 'Penggunaan barang'
            ]);
        }
    }
}
