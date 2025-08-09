<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $suppliers = Supplier::all();

        if ($categories->isEmpty() || $suppliers->isEmpty()) {
            $this->command->warn('Kategori atau Supplier belum ada, seeder produk dilewati.');
            return;
        }

        $products = [
            [
                'name' => 'Kertas A4',
                'description' => 'Kertas ukuran A4 80gsm',
                'purchase_price' => 35000,
                'selling_price' => 50000,
                'minimum_stock' => 10
            ],
            [
                'name' => 'Pulpen Hitam',
                'description' => 'Pulpen tinta hitam berkualitas',
                'purchase_price' => 3000,
                'selling_price' => 5000,
                'minimum_stock' => 50
            ],
            [
                'name' => 'Buku Tulis',
                'description' => 'Buku tulis 40 lembar',
                'purchase_price' => 4000,
                'selling_price' => 7000,
                'minimum_stock' => 30
            ],
            [
                'name' => 'Stapler Mini',
                'description' => 'Stapler ukuran kecil untuk keperluan kantor',
                'purchase_price' => 15000,
                'selling_price' => 25000,
                'minimum_stock' => 5
            ],
            [
                'name' => 'Penghapus',
                'description' => 'Penghapus pensil putih',
                'purchase_price' => 2000,
                'selling_price' => 4000,
                'minimum_stock' => 20
            ],
        ];

        foreach ($products as $p) {
            Product::create([
                'category_id' => $categories->random()->id,
                'supplier_id' => $suppliers->random()->id,
                'name' => $p['name'],
                'sku' => strtoupper(Str::random(8)), // SKU random
                'description' => $p['description'],
                'purchase_price' => $p['purchase_price'],
                'selling_price' => $p['selling_price'],
                'image' => null,
                'minimum_stock' => $p['minimum_stock'],
            ]);
        }
    }
}
