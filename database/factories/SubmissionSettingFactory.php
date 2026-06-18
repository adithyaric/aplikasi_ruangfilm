<?php

namespace Database\Factories;

use App\Models\SubmissionSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubmissionSettingFactory extends Factory
{
    protected $model = SubmissionSetting::class;

    public function definition()
    {
        $openAt = now()->subDay();

        return [
            'name' => 'Submission ' . $this->faker->monthName() . ' ' . now()->year,
            'open_at' => $openAt,
            'close_at' => (clone $openAt)->addDays(7),
        ];
    }
}
