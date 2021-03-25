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
            'name'       => 'Admin',
            'email'      => 'admin@gmail.com',
            'password'   => bcrypt('asdfqwer'),
        ]);
        
                
        User::create([
            'name'       => 'Matheus',
            'email'      => 'matheus@gmail.com',
            'password'   => bcrypt('matheus'),
        ]);

        User::create([
            'name'       => 'Vagner',
            'email'      => 'vagner@gmail.com',
            'password'   => bcrypt('vagner'),
        ]);

        User::create([
            'name'       => 'Paulo',
            'email'      => 'paulo@gmail.com',
            'password'   => bcrypt('paulo'),
        ]);

    }
}
