<?php

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivityTableSeeder extends Seeder
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
        DB::table('activities')->delete();
       
        Activity::create([
                       
            'user_id'                => 1,
            'type_activity_id'       => 1,
            'date'                   => '2021-01-01',
            'ground_id'              => 1,
            'product_id'             => 1,
            'worker_id'              => 1,
            'start_time'             => '00:00',
            'final_time'             => '00:00',
            'worked_hours'           => 1.5,
            'note'                   => 'Bla bla bla',

        ]);

        Activity::create([
                       
            'user_id'                => 1,
            'type_activity_id'       => 2,
            'date'                   => '2021-01-02',
            'ground_id'              => 1,
            'product_id'             => 1,
            'worker_id'              => 2,
            'start_time'             => '00:00',
            'final_time'             => '00:00',
            'worked_hours'           => 2.0,
            'note'                   => 'Bla bla bla',

        ]);

        Activity::create([
                       
            'user_id'                => 1,
            'type_activity_id'       => 3,
            'date'                   => '2021-01-03',
            'ground_id'              => 2,
            'product_id'             => 2,
            'worker_id'              => 3,
            'start_time'             => '00:00',
            'final_time'             => '00:00',
            'worked_hours'           => 3.0,
            'note'                   => 'Bla bla bla',

        ]);

        // Habilita novamente checagem de chaves *Importante*   
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

    }
}
