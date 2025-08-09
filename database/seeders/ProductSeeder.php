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

        if ($categories->count() === 0 || $suppliers->count() === 0) {
            $this->command->warn(' Category dan Supplier harus di-seed terlebih dahulu.');
            return;
        }

        $products = [
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
        ];

        foreach ($products as $data) {
            Product::create([
                'category_id' => $categories->random()->id,
                'supplier_id' => $suppliers->random()->id,
                'name' => $data['name'],
                'sku' => strtoupper(Str::random(8)), // SKU unik
                'description' => $data['description'],
                'purchase_price' => $data['purchase_price'],
                'selling_price' => $data['selling_price'],
                'image' => $data['image'],
                'minimum_stock' => $data['minimum_stock'],
            ]);
        }
    }
}
