<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('roles')->insert([[
            'role_name' => 'admin',

        ], [
            'role_name' => 'pelanggan'
        ]]);

        DB::table('users')->insert([
            'name' => 'Mochamad Rizky',
            'email' => 'rizkyzetzet121@gmail.com',
            'password' => bcrypt('qwer121'),
            'role_id' => 1,
            'email_verified_at' => now()
        ]);
    }
}
