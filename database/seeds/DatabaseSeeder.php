<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'Vu Vuong',
            'email' => 'minhvu.261294@gmail.com',
            'password' => bcrypt('babyno1994'),
            'role_id' => 1,
            'is_active' => 1
        ]);

        DB::table('roles')->insert([
            'name' => 'administrator',
        ]);
        DB::table('roles')->insert([
            'name' => 'editor',
        ]);
        DB::table('roles')->insert([
            'name' => 'user',
        ]);
    }
}
