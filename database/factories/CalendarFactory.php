<?php

namespace Database\Factories;

use App\Models\Calendar;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalendarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Calendar::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->word(),
            'title' => $this->faker->sentence(10),
            'description' => $this->faker->sentence(15),
            'pdf' => $this->faker->text(),
            'publish' => $this->faker->boolean(),
        ];
    }
}
