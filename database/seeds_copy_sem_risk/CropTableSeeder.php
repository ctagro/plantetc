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
            'crop_name'     => 'Pimentão',
            'name'          => 'Pimentão Misto',
            'description'   => 'Pimentão Amarelo e Vermelho em estufa',
            'packing'       => 'Caixa',
            'unity'         => 'cx',
            'in_use'       => 'S',
            'image'         => 'crop_avatar.png',
            'note'          => '...',
        ]);

        Crop::create([
                       
            'user_id'       => 1,
            'crop_name'     => 'Pimentão',
            'name'          => 'Pimentão Amarelo',
            'description'   => 'Pimentão Amarelo em estufa',
            'packing'       => 'Caixa',
            'unity'         => 'cx',
            'in_use'       => 'S',
            'image'         => 'crop_avatar.png',
            'note'          => '...',
        ]);

        Crop::create([
                       
            'user_id'       => 1,
            'crop_name'     => 'Pimentão',
            'name'          => 'Pimentão Vermelho',
            'description'   => 'Pimentão Vermelho em estufa',
            'packing'       => 'Caixa',
            'unity'         => 'cx',
            'in_use'       => 'S',
            'image'         => 'crop_avatar.png',
            'note'          => '...',
        ]);

        Crop::create([
                       
            'user_id'       => 1,
            'crop_name'     => 'Abacate',
            'name'          => 'Abacate Comum',
            'description'   => 'Abacate do tipo Geada, Fortuna no mesmo terreno ',
            'packing'       => 'Caixa',
            'unity'         => 'cx',
            'in_use'       => 'S',
            'image'         => 'crop_avatar.png',
            'note'          => '...',
        ]);

        Crop::create([
                       
            'user_id'       => 1,
            'crop_name'     => 'Abacate',
            'name'          => 'Abacate Hass',
            'description'   => 'Abacate do tipo Hass e de comercialização restrita',
            'packing'       => 'Caixa',
            'unity'         => 'cx',
            'in_use'       => 'S',
            'image'         => 'crop_avatar.png',
            'note'          => '...',
        ]);

        Crop::create([
                       
            'user_id'       => 1,
            'crop_name'     => 'Feijão',
            'name'          => 'Feijão roxinho',
            'description'   => 'Feijão vermelho',
            'image'         => 'crop_avatar.png',
            'packing'       => 'Saca',
            'unity'         => 'sc',
            'in_use'       => 'S',
            'image'         => 'crop_avatar.png',
            'note'          => '...',
        ]);
      
        // Habilita novamente checagem de chaves *Importante*   
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
