<?php

namespace Database\Factories;

use App\Models\Jiri;
use App\Models\User;
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
            'description' => $this->faker->optional()->text(),
            /*            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),*/
            'user_id' => rand(1, count(User::all())-1)
        ];
    }

    public function withoutName(): JiriFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => null,
            ];
        });
    }

    public function withoutDate(): JiriFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'date' => null,
            ];
        });
    }

    public function withInvalidDate(): JiriFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'date' => 'toto',
            ];
        });
    }
}
