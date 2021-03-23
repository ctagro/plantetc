<?php

use Illuminate\Database\Seeder;
use App\Models\Ground;

class GroundTableSeeder extends Seeder
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
        DB::table('grounds')->delete();

        
        Ground::create([
                       
            'user_id'    => 1,
            'name'       => 'Estufa 1',
            'area'       => 0.21,
            'location'   => 'Primeira estufa de baixo para cima',
            'in_use'       => 'S',
            'image'      => 'ground_avatar.png',
        ]);

        Ground::create([
                       
            'user_id'    => 1,
            'name'       => 'Estufa 2',
            'area'       => 0.21,
            'location'   => 'Segunda estufa de baixo para cima',
            'in_use'       => 'S',
            'image'      => 'ground_avatar.png',
        ]);

        Ground::create([
                       
            'user_id'    => 1,
            'name'       => 'Estufa 3',
            'area'       => 0.21,
            'location'   => 'Terceira estufa de baixo para cima',
            'in_use'       => 'S',
            'image'      => 'ground_avatar.png',
        ]);
        
        // Habilita novamente checagem de chaves *Importante*   
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

    }
}
