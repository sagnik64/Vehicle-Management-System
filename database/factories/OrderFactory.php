<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vehicle_type_id' => $this->faker->numberBetween(1, 12),
            'vehicle_type' => 'car',
            'customer_user_id' => $this->faker->numberBetween(1, 12),
            'dealer_user_id' => $this->faker->numberBetween(1, 12),
            'payment_mode' => $this->faker->numberBetween(1, 4),
            'transaction_reference' => 'ACBD1234',
            'added_on' => $this->faker->date('Y-m-d', 'now'),
            'status' => '1'
        ];
    }
}
