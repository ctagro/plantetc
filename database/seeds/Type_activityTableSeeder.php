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
             'description'  => 'Colheita',
             'image'        => 'type_activity_avatar.png',
             'note'         => 'Colheita de qualquer tipo de Pimentão',
             'in_use'       => 'S',
         ]);

         Type_activity::create([
                        
            'user_id'      => 1,
            'description'  => 'Pulverização',
            'image'        => 'type_activity_avatar.png',
            'note'         => 'Aplicação de produtos usando o pulverizador',
            'in_use'       => 'S',
        ]);

        Type_activity::create([
                        
            'user_id'      => 1,
            'description'  => 'Fitamento',
            'image'        => 'type_activity_avatar.png',
            'note'         => 'Fitamento do pimentão',
            'in_use'       => 'S',
        ]);

        Type_activity::create([
                        
            'user_id'      => 1,
            'description'  => 'Embalamento',
            'image'        => 'type_activity_avatar.png',
            'note'         => 'Atividade de limpar e encaixotar o pimentão',
            'in_use'       => 'S',
        ]);

        Type_activity::create([
                        
            'user_id'      => 1,
            'description'  => 'Irrigação',
            'image'        => 'type_activity_avatar.png',
            'note'         => 'Atividade de transportar qualquer produto',
            'in_use'       => 'S',
        ]);

        Type_activity::create([
                        
            'user_id'      => 1,
            'description'  => 'Limpeza',
            'image'        => 'type_activity_avatar.png',
            'note'         => 'Limpeza se refere a atividade de capina, roçagem e limpeza propriamente dita',
            'in_use'       => 'S',
        ]);

        Type_activity::create([
                        
            'user_id'      => 1,
            'description'  => 'Outra atividade',
            'image'        => 'type_activity_avatar.png',
            'note'         => 'O que não se encaixa nos itens relacionados acima',
            'in_use'       => 'S',
        ]);
       

         // Habilita novamente checagem de chaves *Importante*   
         DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
