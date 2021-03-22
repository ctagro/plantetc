<?php

use Illuminate\Database\Seeder;
use App\Models\Type_activity;

class Type_activityTableSeeder extends Seeder
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
         DB::table('type_activities')->delete();
   
         Type_activity::create([
                        
             'user_id'      => 1,
             'description'  => 'Aplicação de Adubo foliar',
             'image'        => 'worker_avatar.png',
             'note'         => 'Aplicação de qualquer adubo foliar usando o pulvirizador',
             'in_use'       => 'S',
         ]);

         Type_activity::create([
                        
            'user_id'      => 1,
            'description'  => 'Aplicação de Herbicidas',
            'image'        => 'worker_avatar.png',
            'note'         => 'Aplicação de qualquer herbicida usando o pulvirizador',
            'in_use'       => 'S',
        ]);

        Type_activity::create([
                        
            'user_id'      => 1,
            'description'  => 'Preparaçao de Canteiros',
            'image'        => 'worker_avatar.png',
            'note'         => 'Preparação de canteiros para novo plantio',
            'in_use'       => 'N',
        ]);
       

         // Habilita novamente checagem de chaves *Importante*   
         DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
