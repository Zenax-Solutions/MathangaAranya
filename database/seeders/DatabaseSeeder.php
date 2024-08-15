<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);

        $this->call(CalendarSeeder::class);
        $this->call(CommunitySeeder::class);
        $this->call(DonationSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(GallerySeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(SpeechSeeder::class);
        $this->call(UserSeeder::class);
    }
}
