<?php

use Illuminate\Database\Seeder;
use App\Models\Crop;

class CropTableSeeder extends Seeder
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
        DB::table('crops')->delete();

        
        Crop::create([
                       
            'user_id'       => 1,
            'name'          => 'Pimentão',
            'description'   => 'Pimentão Amarelo e Vermelho em estufa',
            'image'         => 'crop_avatar.png',
        ]);

        Crop::create([
                       
            'user_id'       => 1,
            'name'          => 'Abacate variados',
            'description'   => 'Abacate do tipo Geada, Fortuna e Hass no mesmo terreno ',
            'image'         => 'crop_avatar.png',
        ]);

        Crop::create([
                       
            'user_id'       => 1,
            'name'          => 'Abacate Hass',
            'description'   => 'Abacate do tipo Hass e de comercialização restrita',
            'image'         => 'crop_avatar.png',
        ]);

        Crop::create([
                       
            'user_id'       => 1,
            'name'          => 'Feijão',
            'description'   => 'Feijão vermelho',
            'image'         => 'crop_avatar.png',
        ]);
      
        // Habilita novamente checagem de chaves *Importante*   
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
