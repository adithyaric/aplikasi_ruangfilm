<?php

namespace Database\Factories;

use App\Models\Expedition;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpeditionFactory extends Factory
{
    protected $model = Expedition::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['JNE', 'J&T', 'SiCepat']),
            'service_name' => $this->faker->randomElement(['REG', 'YES', 'ECO']),
            'fee' => $this->faker->numberBetween(10000, 30000),
            'is_active' => true,
        ];
    }
}
