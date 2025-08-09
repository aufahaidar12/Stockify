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
            // Produk dari versi pertama
            [
                'name' => 'Laptop ASUS ROG Strix',
                'description' => 'Laptop gaming dengan performa tinggi.',
                'purchase_price' => 15000000,
                'selling_price' => 17500000,
                'image' => 'images/products/laptop_asus.jpg',
                'minimum_stock' => 5
            ],
            [
                'name' => 'Kaos Polos Hitam',
                'description' => 'Kaos polos berbahan katun nyaman dipakai.',
                'purchase_price' => 45000,
                'selling_price' => 75000,
                'image' => 'images/products/kaos_hitam.jpg',
                'minimum_stock' => 20
            ],
            [
                'name' => 'Biskuit Cokelat',
                'description' => 'Biskuit renyah dengan lapisan cokelat manis.',
                'purchase_price' => 15000,
                'selling_price' => 25000,
                'image' => 'images/products/biskuit_cokelat.jpg',
                'minimum_stock' => 50
            ],

            // Produk dari versi kedua
            [
                'name' => 'Kertas A4',
                'description' => 'Kertas ukuran A4 80gsm',
                'purchase_price' => 35000,
                'selling_price' => 50000,
                'image' => null,
                'minimum_stock' => 10
            ],
            [
                'name' => 'Pulpen Hitam',
                'description' => 'Pulpen tinta hitam berkualitas',
                'purchase_price' => 3000,
                'selling_price' => 5000,
                'image' => null,
                'minimum_stock' => 50
            ],
            [
                'name' => 'Buku Tulis',
                'description' => 'Buku tulis 40 lembar',
                'purchase_price' => 4000,
                'selling_price' => 7000,
                'image' => null,
                'minimum_stock' => 30
            ],
            [
                'name' => 'Stapler Mini',
                'description' => 'Stapler ukuran kecil untuk keperluan kantor',
                'purchase_price' => 15000,
                'selling_price' => 25000,
                'image' => null,
                'minimum_stock' => 5
            ],
            [
                'name' => 'Penghapus',
                'description' => 'Penghapus pensil putih',
                'purchase_price' => 2000,
                'selling_price' => 4000,
                'image' => null,
                'minimum_stock' => 20
            ],
        ];

        foreach ($products as $p) {
            Product::create([
                'category_id' => $categories->random()->id,
                'supplier_id' => $suppliers->random()->id,
                'name' => $p['name'],
                'sku' => strtoupper(Str::random(8)), // SKU unik
                'description' => $p['description'],
                'purchase_price' => $p['purchase_price'],
                'selling_price' => $p['selling_price'],
                'image' => $p['image'],
                'minimum_stock' => $p['minimum_stock'],
            ]);
        }
    }
}
