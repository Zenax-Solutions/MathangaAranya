<?php

namespace Database\Seeders;

use App\Models\Speech;
use Illuminate\Database\Seeder;

class SpeechSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Speech::factory()
            ->count(5)
            ->create();
    }
}
