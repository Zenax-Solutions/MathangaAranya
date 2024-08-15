<?php

namespace Database\Factories;

use App\Models\Speech;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpeechFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Speech::class;

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
            'description' => $this->faker->text(),
            'data' => $this->faker->text(255),
            'publish' => $this->faker->boolean(),
        ];
    }
}
