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

                'user_id'               => 1,
                'account_id'            => 1,
                'date'                  => date('2021-01-01'),
                'date_pay'              => date('2021-02-01'),
                'crop_id'               => 1,
                'ground_id'             => 1,
                'type_account_id'       => 3,
                'amount'                => 10,
                'unity'                 => 'cx',
                'price_unit'            => 50,
                'bayer_id'              => 1,
                'note'                  => 'Teste de vendas',       

        ]);

        // Habilita novamente checagem de chaves *Importante*   
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
