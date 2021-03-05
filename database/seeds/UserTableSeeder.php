<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'       => 'Joao Loures',
            'email'      => 'louresvale@gmail.com',
            'password'   => bcrypt('asdfqwer'),
        ]);

        User::create([
            'name'       => 'Joao Loures Vale',
            'email'      => 'jp.loures.vale@gmail.com',
            'password'   => bcrypt('asdfqwer'),
        ]);

        User::create([
            'name'       => 'Joao Vale',
            'email'      => 'joao.vale@gmail.com',
            'password'   => bcrypt('asdfqwer'),
        ]);
    }
}
