<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Humas RSUD Merdeka Bintaro',
            'username' => \Str::slug('Humas RSUD Merdeka Bintaro'),
            'password' => bcrypt('rsudmerdekabintarojaya'),
            'email' => 'humas@rsudmerdekabintaro.com',
        ]);
    }
}
