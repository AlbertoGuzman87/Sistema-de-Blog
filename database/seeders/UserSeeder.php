<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'Juan Alberto Guzmán Gómez',
            'email' => 'juanalbertoguzman87@gmail.com',
            'password' => bcrypt('estrella234'),
        ])->assignRole('Admin');

        \App\Models\User::factory(9)->create();
    }
}
