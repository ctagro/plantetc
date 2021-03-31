<?php

use App\Models\Type_account;
use Illuminate\Database\Seeder;

class TypeAccountSeeder extends Seeder
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
         DB::table('type_accounts')->delete();
 
         
         Type_account::create([
                        
             
             'name'       => 'Despesa',
           
         ]);
 
         Type_account::create([
                        
             
             'name'       => 'Investimento',
            
         ]);
 

         Type_account::create([
                        
            
            'name'       => 'Receita',
       
        ]);
         
         // Habilita novamente checagem de chaves *Importante*   
         DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
 
     }
    }

