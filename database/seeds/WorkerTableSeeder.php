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
            'date'       => '2021-01-01',
            'salary'     => 1200,
            'salary_hour'=> 5.45,
            'in_use'       => 'S',
            'image'      => 'worker_avatar.png',
        ]);

        Worker::create([
                       
            'user_id'    => 1,
            'name'       => 'Mathes',
            'date'       => '2021-01-02',
            'salary'     => 1200,
            'salary_hour'=> 5.45,
            'in_use'       => 'S',
            'image'      => 'worker_avatar.png',
        ]);

        Worker::create([
                       
            'user_id'    => 1,
            'name'       => 'Júlio',
            'date'       => '2021-01-03',
            'salary'     => 1200,
            'salary_hour'=> 5.45,
            'in_use'       => 'S',
            'image'      => 'worker_avatar.png',
        ]);
      
        // Habilita novamente checagem de chaves *Importante*   
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
