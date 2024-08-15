<?php

namespace Database\Factories;

use App\Models\Community;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommunityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Community::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'address' => $this->faker->text(),
            'date' => $this->faker->date(),
            'type' => $this->faker->word(),
            'description' => $this->faker->sentence(15),
            'slip' => $this->faker->text(255),
        ];
    }
}
