<?php

use Illuminate\Database\Seeder;
use App\Models\Sale;


class SaleTableSeeder extends Seeder
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
        DB::table('sales')->delete();
       
        Sale::create([

            'user_id'                => 1,
            'account_id'             => 1,
            'date'                   => '2021-01-01',
    //        'date_delivery'          => '2021-01-02',
            'crop_id'                => 1,
            'ground_id'              => 1,
            'type_account_id'        => 3,
            'amount'                 => 10,
            'unity'                  => "cx",
            'price_unit'             => 50,
            'bayer_id'               => 1,
    //        'transporter_id'         => 1,
    //        'cost_freight'           => 300,
            'note'                   => 'Bla bla bla',   

        ]);

        Sale::create([

            'user_id'                => 1,
            'account_id'             => 1,
            'date'                   => '2021-01-01',
     //       'date_delivery'          => '2021-01-02',
            'crop_id'                => 2,
            'ground_id'              => 1,
            'type_account_id'        => 3,
            'amount'                 => 50,
            'unity'                  => "cx",
            'price_unit'             => 60,
            'bayer_id'               => 1,
     //       'transporter_id'         => 1,
     //       'cost_freight'           => 400,
            'note'                   => 'Bla bla bla',   

        ]);

        Sale::create([

            'user_id'                => 1,
            'account_id'             => 3,
            'date'                   => '2021-01-01',
    //        'date_delivery'          => '2021-01-02',
            'crop_id'                => 3,
            'ground_id'              => 1,
            'type_account_id'        => 3,
            'amount'                 => 10,
            'unity'                  => "cx",
            'price_unit'             => 50,
            'bayer_id'               => 1,
    //        'transporter_id'         => 1,
    //        'cost_freight'           => 300,
            'note'                   => 'Bla bla bla',   

        ]);

        // Habilita novamente checagem de chaves *Importante*   
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

    
    }
}
