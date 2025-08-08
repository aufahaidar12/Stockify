<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'PT Sumber Makmur',
                'phone' => '081234567890',
                'address' => 'Jl. Raya Industri No. 10, Jakarta'
            ],
            [
                'name' => 'CV Berkah Jaya',
                'phone' => '082198765432',
                'address' => 'Jl. Sukajadi No. 21, Bandung'
            ],
            [
                'name' => 'Toko Grosir Sentosa',
                'phone' => '081355588899',
                'address' => 'Jl. Malioboro No. 8, Yogyakarta'
            ]
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
