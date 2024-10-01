<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition()
    {
        return [
            'client_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'telephone' => $this->faker->phoneNumber,
            'birthdate' => $this->faker->date(),
            'address_line_1' => $this->faker->streetAddress,
            'address_line_2' => $this->faker->secondaryAddress,
            'neighborhood' => $this->faker->city,
            'zip' => $this->faker->postcode,
        ];
    }
}
