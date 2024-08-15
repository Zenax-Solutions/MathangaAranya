<?php

namespace Database\Factories;

use App\Models\Donation;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Donation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->word(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'address' => $this->faker->address(),
            'date' => $this->faker->date(),
            'description' => $this->faker->sentence(15),
            'slip' => $this->faker->text(255),
        ];
    }
}
