<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $time = microtime(1);

        return [
            'product_name' => $this->faker->unique()->randomElement([
                'iPhone 15',
                'Apple Vison',
                'Playstation 5'
            ]),
            'price' => $this->faker->randomNumber(2),
            'photo' => hash('sha256', (microtime(1) - $time) * 1000) . '.jpg',
            'product_type_id' => ProductType::factory()->create()->product_type_id
        ];
    }
}
