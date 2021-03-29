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
     // 1   
         Account::create([                       
             'user_id'                => 1,
             'date'                   => '2021-01-01',
             'description'            => 'Preparaçao de Canteiros',
             'type_account_id'        => 1,
             'ground_id'              => 1,
             'accounting_id'          => 1,
             'amount'                 => 1000,
             'activity'               => 'S',
             'note'                   => 'Bla bla bla',
         ]);

         // 2

         Account::create([                       
            'user_id'                => 1,
            'date'                   => '2021-01-02',
            'description'            => 'Colheita',
            'type_account_id'        => 3,
            'ground_id'              => 2,
            'accounting_id'          => 2,
            'amount'                 => 2000,
            'activity'               => 'S',
            'note'                   => 'Bla bla bla',
        ]);

         // 3

        Account::create([                       
            'user_id'                => 1,
            'date'                   => '2021-01-01',
            'description'            => 'Aplicação de Herbicida', 
            'type_account_id'        => 2,
            'ground_id'              => 3,
            'accounting_id'          => 2,
            'amount'                 => 3000,
            'activity'               => 'S',
            'note'                   => 'Bla bla bla',
        ]);

         // 4

        Account::create([                       
            'user_id'                => 1,
            'date'                   => '2021-01-01',
            'description'            => 'Mario Wilson',
            'type_account_id'        => 3,
            'ground_id'              => 1,
            'accounting_id'          => 3,
            'amount'                 => 100,
            'activity'               => 'N',
            'note'                   => 'Bla bla bla',
        ]);

        // 5

        Account::create([                       
           'user_id'                => 1,
           'date'                   => '2021-01-02',
           'description'            => 'Dedé',
           'type_account_id'        => 3,
           'ground_id'              => 2,
           'accounting_id'          => 4,
           'amount'                 => 200,
           'activity'               => 'C',  
           'note'                   => 'Bla bla bla',
       ]);

       // 6

       Account::create([                       
           'user_id'                => 1,
           'date'                   => '2021-01-01',
           'description'            => 'Dedé', 
           'type_account_id'        => 3,
           'ground_id'              => 3,
           'accounting_id'          => 3,
           'amount'                 => 300,
           'activity'               => 'N',
           'note'                   => 'Bla bla bla',
       ]);

       // 7

       Account::create([                       
        'user_id'                => 1,
        'date'                   => '2021-01-01',
        'description'            => 'Aplicação de Herbicida', 
        'type_account_id'        => 2,
        'ground_id'              => 3,
        'accounting_id'          => 2,
        'amount'                 => 1230,
        'activity'               => 'N',
        'note'                   => 'Bla bla bla',
    ]);

    // 8

    Account::create([                       
        'user_id'                => 1,
        'date'                   => '2021-01-01',
        'description'            => 'Herbicida 1', 
        'type_account_id'        => 1,
        'ground_id'              => 2,
        'accounting_id'          => 3,
        'amount'                 => 100,
        'activity'               => 'N',
        'note'                   => 'Bla bla bla',
    ]);


    // 9

    Account::create([                       
        'user_id'                => 1,
        'date'                   => '2021-01-02',
        'description'            => 'Herbicida 2', 
        'type_account_id'        => 1,
        'ground_id'              => 2,
        'accounting_id'          => 3,
        'amount'                 => 200,
        'activity'               => 'N',
        'note'                   => 'Bla bla bla',
    ]);
        
        // Habilita novamente checagem de chaves *Importante*   
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
  
    }
}
