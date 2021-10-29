<?php

use Illuminate\Database\Seeder;
use App\Models\Product_apply;

class ProductApplySeeder extends Seeder
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
         DB::table('product_applies')->delete();
        
         Product_apply::create([
                        
             'user_id'                => 1,
             'account_id'             => 8,
             'date'                   => '2021-01-01',
             'product_id'             => 1,
             'worker_id'              => 1,
             'accounting_id'          => 3,
             'ground_id'              => 2,
             'amount'                 => 100,   
             'note'                   => 'Bla bla bla',
 
         ]);

         Product_apply::create([
                        
            'user_id'                => 1,
            'account_id'             => 9,
            'date'                   => '2021-01-02',
            'product_id'             => 2,
            'worker_id'              => 2,
            'accounting_id'          => 3,
            'ground_id'              => 2,
            'amount'                 => 200,   
            'note'                   => 'Bla bla bla',

        ]);


        // Habilita novamente checagem de chaves *Importante*   
         DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
