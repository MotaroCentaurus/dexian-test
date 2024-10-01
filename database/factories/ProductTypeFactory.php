<?php

namespace Database\Factories;

use App\Models\ProductType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductTypeFactory extends Factory
{
    protected $model = ProductType::class;

    public function definition()
    {
        return [
            'product_type' => $this->faker->unique()->randomElement([
                'Torta',
                'Pastel',
                'Bolo'
            ]),
        ];
    }
}
