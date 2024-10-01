<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productTypes = [
            'Cake',
            'Pie',
            'Pastel',
            'Cookie',
            'Coffee',
        ];

        foreach ($productTypes as $type) {
            \App\Models\ProductType::create([
                'product_type' => $type
            ]);
        }
    }
}
