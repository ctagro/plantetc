<?php

use Illuminate\Database\Seeder;
use App\Models\Status_inventory;

class StatusInventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
         DB::table('status_inventories')->delete();
 
         
         Status_inventory::create([
                        
             
             'name'       => 'Estoque confortável',
           
         ]);
 
         Status_inventory::create([
                        
             
             'name'       => 'Estoque no limite',
            
         ]);
 

         Status_inventory::create([
                        
            
            'name'       => 'Repor Estoque',
       
        ]);
         
         // Habilita novamente checagem de chaves *Importante*   
         DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
 
     }

    }

