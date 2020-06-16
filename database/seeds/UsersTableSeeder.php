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
        $user = \App\User::Create([
          'first_name' => 'super',
          'last_name' => 'admin',
          'email' => 'super_admin@app.com',
          'password' => bcrypt('1'),
        ]);
        $user->attachRole('super_admin');
    }
}
