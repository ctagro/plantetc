<?php

use Illuminate\Database\Seeder;
use App\Models\Pesticide;

class PesticideTableSeeder extends Seeder
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
         DB::table('pesticides')->delete();
 
         
         Pesticide::create([
                        
             'user_id'        => 1,
             'name'           => 'Nitrato de Calcio Haifa',
             'Description'    => 'Comprado em 05/03/2021 - 2 sacos',
             'packing'        => 'Saco de 25 Kg',
              'unity'         => 'Kg',
              'price'         => 89.57,
              'price_unit'    => 3.59,
             'type_pesticide'   => 'N',
             'note'           => '?',
             'image'          => 'pesticide_avatar.png',
         ]);

          
         Pesticide::create([
                        
          'user_id'        => 1,
          'name'           => 'MAP Purificado 12.61 Haifa',
          'Description'    => 'Comprado em 05/03/2021 - 2 sacos',
          'packing'        => 'Saco de 25 Kg',
          'unity'         => 'Kg',
          'price'         => 220.14,
          'price_unit'    => 8.00,
          'type_pesticide'   => 'N',
          'note'           => '?',
          'image'          => 'pesticide_avatar.png',
      ]);

      Pesticide::create([
                        
          'user_id'        => 1,
          'name'           => 'MKP 00.52.34 Haifa',
          'Description'    => 'Comprado em 05/03/2021 - 1 sacos',
          'packing'        => 'Saco de 25 Kg',
           'unity'         => 'Kg',
           'price'         => 274.67,
           'price_unit'    => 11.00,
          'type_pesticide'   => 'N',
          'note'           => '?',
          'image'          => 'pesticide_avatar.png',
      ]);

         Pesticide::create([
                        
          'user_id'        => 1,
          'name'           => 'Furiu s Fert  01 L',
          'Description'    => 'Comprado em 05/03/2021 - 1 litro',
          'packing'        => 'Litro',
          'unity'          => 'ml',
          'price'          => 80.22,
          'price_unit'     => 0.08,
          'type_pesticide'   => 'S',
          'in_use'       => 'S',
          'note'           => '?',
          'image'          => 'pesticide_avatar.png',
      ]);

      Pesticide::create([
                        
          'user_id'        => 1,
          'name'           => 'Fertiliza Avalon 01 L',
          'Description'    => 'Comprado em 05/03/2021 - 1 litro',
          'packing'        => 'Litro',
          'unity'          => 'ml',
          'price'          => 249.65,
          'price_unit'     => 0.25,
          'type_pesticide'   => 'S',
          'in_use'       => 'S',
          'note'           => '?',
          'image'          => 'pesticide_avatar.png',
      ]);

      Pesticide::create([
                        
          'user_id'        => 1,
          'name'           => 'Connect Onu 2902',
          'Description'    => 'Comprado em 05/03/2021 - 1 litro',
          'packing'        => 'Litro',
          'unity'          => 'ml',
          'price'          => 69.14,
          'price_unit'     => 0.70,
          'type_pesticide'   => 'S',
          'in_use'         => 'S',
          'note'           => '?',
          'image'          => 'pesticide_avatar.png',
      ]);

      Pesticide::create([
                        
          'user_id'        => 1,
          'name'           => 'Nitrato de potássio Haifa',
          'Description'    => 'Comprado em 05/03/2021 - 1 litro',
          'packing'        => 'Litro',
          'unity'          => 'ml',
          'price'          => 179.25,
          'price_unit'     => 0.18,
          'type_pesticide'   => 'S',
          'in_use'         => 'S',
          'note'           => '?',
          'image'          => 'pesticide_avatar.png',
      ]);

      Pesticide::create([
                        
          'user_id'        => 1,
          'name'           => 'Feriliza Aminoprol',
          'Description'    => 'Comprado em 05/03/2021 - 1 litro',
          'packing'        => 'Litro',
          'unity'          => 'ml',
          'price'          => 141.88,
          'price_unit'     => 0.14,
          'type_pesticide'   => 'S',
          'in_use'         => 'S',
          'note'           => '?',
          'image'          => 'pesticide_avatar.png',
      ]);

      Pesticide::create([
                        
          'user_id'        => 1,
          'name'           => 'Fertiliza Patrono',
          'Description'    => 'Comprado em 05/03/2021 - 1 litro',
          'packing'        => 'Litro',
          'unity'          => 'ml',
          'price'          => 425.22,
          'price_unit'     => 0.43,
          'type_pesticide'   => 'S',
          'in_use'         => 'S',
          'note'           => '?',
          'image'          => 'pesticide_avatar.png',
      ]);

      Pesticide::create([
                        
          'user_id'        => 1,
          'name'           => 'Fertiliza Aliado',
          'Description'    => 'Comprado em 05/03/2021 - 1 litro',
          'packing'        => 'Litro',
          'unity'          => 'ml',
          'price'          => 182.16,
          'price_unit'     => 0.18,
          'type_pesticide'   => 'S',
          'in_use'         => 'S',
          'note'           => '?',
          'image'          => 'pesticide_avatar.png',
      ]);

      Pesticide::create([
                        
          'user_id'        => 1,
          'name'           => 'Não se aplica',
          'Description'    => 'Quando do cadastro de atividade não há utilização de produto',
          'packing'        => 'NA',
          'unity'          => 'NA',
          'price'          => 0.01,
          'price_unit'     => 0.01,
          'type_pesticide'   => 'S',
          'in_use'         => 'S',
          'note'           => '?',
          'image'          => 'pesticide_avatar.png',
      ]);

     



         
         // Habilita novamente checagem de chaves *Importante*   
         DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
