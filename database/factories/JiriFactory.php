<?php

namespace Database\Factories;

use App\Models\Jiri;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class JiriFactory extends Factory
{
    protected $model = Jiri::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'date' => Carbon::now(),
            'description' => $this->faker->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
