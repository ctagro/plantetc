<?php

use Illuminate\Database\Seeder;
use App\Models\Worker;



class WorkerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Desabilita a checagem de chaves
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('workers')->delete();

        
        Worker::create([
                       
            'user_id'    => 1,
            'name'       => 'Vagner',
            'date'       => '2018-01-01',
            'salary'     => 1650,
            'salary_hour'=> 13.49,
            'in_use'       => 'S',
            'image'      => 'worker_avatar.png',
        ]);

        Worker::create([
                       
            'user_id'    => 1,
            'name'       => 'Mathes',
            'date'       => '2021-03-01',
            'salary'     => 1200,
            'salary_hour'=> 9.17,
            'in_use'       => 'S',
            'image'      => 'worker_avatar.png',
        ]);

        Worker::create([
                       
            'user_id'    => 1,
            'name'       => 'Paulo',
            'date'       => '2017-01-01',
            'salary'     => 3200,
            'salary_hour'=> 22.17,
            'in_use'       => 'S',
            'image'      => 'worker_avatar.png',
        ]);

        Worker::create([
                       
            'user_id'    => 1,
            'name'       => 'Leandro',
            'date'       => '2019-01-01',
            'salary'     => 1650,
            'salary_hour'=> 15.76,
            'in_use'       => 'S',
            'image'      => 'worker_avatar.png',
        ]);

        Worker::create([
                       
            'user_id'    => 1,
            'name'       => 'Júlio',
            'date'       => '2021-03-01',
            'salary'     => 1600,
            'salary_hour'=> 9.09,
            'in_use'       => 'S',
            'image'      => 'worker_avatar.png',
        ]);
      
        // Habilita novamente checagem de chaves *Importante*   
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
