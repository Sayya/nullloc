<?php

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
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@mail',
            'password' => bcrypt('admin@mail'),
        ]);
        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@mail',
            'password' => bcrypt('user@mail'),
        ]);
    }
}
