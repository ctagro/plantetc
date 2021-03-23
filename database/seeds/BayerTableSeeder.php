<?php

use Illuminate\Database\Seeder;
use App\Models\Bayer;

class BayerTableSeeder extends Seeder
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
       DB::table('bayers')->delete();
 
       Bayer::create([
                      
           'user_id'      => 1,
           'name'         => 'Dedé',
           'image'        => 'bayer_avatar.png',
           'in_use'       => 'S',
           'note'         => 'O produto deve ser levado a Vasconselos até as 17hs',
       ]);

       Bayer::create([
                      
          'user_id'      => 1,
          'name'         => 'Mario Wilson',
          'image'        => 'bayer_avatar.png',
          'in_use'       => 'S',
          'note'         => 'Carrega na fazenda as 11hs do dia anterior',
      ]);

      Bayer::create([
                      
          'user_id'      => 1,
          'name'         => 'André',
          'image'        => 'bayer_avatar.png',
          'in_use'       => 'S',
          'note'         => 'Representa o Atacadista Benassi o trasporte deve ser providenciado ate o Ceasa',
      ]);
     

       // Habilita novamente checagem de chaves *Importante*   
       DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

  }
}
