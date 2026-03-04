<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Feature::factory(100)->create();

        User::factory()->create([
            'name' => 'Rui Fernandes',
            'email' => 'rui95fer@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
