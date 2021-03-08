<?php

use Illuminate\Database\Seeder;
use App\Models\Account;

class AccountTableSeeder extends Seeder
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
         DB::table('accounts')->delete();
        
         Account::create([                       
             'user_id'                => 1,
             'date'                   => '2021-01-01',
             'description'            => 'Compra de fertilizante',
             'type'                   => 'D',
             'ground_id'              => 1,
             'accounting_id'          => 1,
             'amount'                 => 1000,
             'note'                   => 'Bla bla bla',
         ]);

         Account::create([                       
            'user_id'                => 1,
            'date'                   => '2021-01-02',
            'description'            => 'Compra de adubo',
            'type'                   => 'D',
            'ground_id'              => 2,
            'accounting_id'          => 1,
            'amount'                 => 1000,
            'note'                   => 'Bla bla bla',
        ]);

        Account::create([                       
            'user_id'                => 1,
            'date'                   => '2021-01-01',
            'description'            => 'Pagamento Vagner', 
            'type'                   => 'D',
            'ground_id'              => 3,
            'accounting_id'          => 2,
            'amount'                 => 1000,
            'note'                   => 'Bla bla bla',
        ]);
        
        // Habilita novamente checagem de chaves *Importante*   
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
  
    }
}
