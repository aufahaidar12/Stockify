<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Elektronik',
                'description' => 'Produk elektronik seperti smartphone, laptop, televisi, dan perangkat lainnya.'
            ],
            [
                'name' => 'Pakaian',
                'description' => 'Berbagai jenis pakaian pria, wanita, dan anak-anak.'
            ],
            [
                'name' => 'Makanan & Minuman',
                'description' => 'Makanan kemasan, minuman, dan bahan masak.'
            ],
            [
                'name' => 'Peralatan Rumah',
                'description' => 'Peralatan rumah tangga dan perlengkapan dapur.'
            ],
            [
                'name' => 'Olahraga',
                'description' => 'Peralatan dan perlengkapan olahraga.'
            ],
            [
                'name' => 'Kesehatan',
                'description' => 'Produk kesehatan dan perawatan tubuh.'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
