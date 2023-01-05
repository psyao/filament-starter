<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'first_name' => 'Steve',
            'last_name'  => 'Aguet',
            'email'      => 'steve.aguet@marvelous.digital',
        ]);

//        User::factory(10)->create();
    }
}
