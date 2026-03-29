<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Feature;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Rui Fernandes',
            'email' => 'rui95fer@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $users = User::factory(20)->create();

        Feature::factory(30)->create()->each(function (Feature $feature) use ($users) {
            Comment::factory(fake()->numberBetween(2, 8))->create([
                'feature_id' => $feature->id,
                'user_id' => fn() => $users->random()->id,
            ]);

            $users->shuffle()->take(fake()->numberBetween(1, 15))->each(function (User $user) use ($feature) {
                Vote::factory()->create([
                    'feature_id' => $feature->id,
                    'user_id' => $user->id,
                ]);
            });
        });
    }
}
