<?php


use Illuminate\Database\Seeder;
use App\Models\Accounting;

class AccountingTableSeeder extends Seeder
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
        DB::table('accountings')->delete();

        
        Accounting::create([
                       
            'user_id'       => 1,
            'name'          => 'Insumos',
            'description'   => 'Tudo que for adquirido para utilização na produção do hortifruti',
            'image'         => 'accounting_avatar.png',
        ]);

        Accounting::create([
                       
            'user_id'       => 1,
            'name'          => 'Adubos',
            'description'   => 'Adubos adquirdos para utilização na produção do hortifruti',
            'image'         => 'accounting_avatar.png',
        ]);

        Accounting::create([
                       
            'user_id'       => 1,
            'name'          => 'Herbicidas',
            'description'   => 'Tudo que for adquirido para combater doenças',
            'image'         => 'accounting_avatar.png',
        ]);

        Accounting::create([
                       
            'user_id'       => 1,
            'name'          => 'Embalagens',
            'description'   => 'Aquisição de embalagens para a venda de hortifruti',
            'image'         => 'accounting_avatar.png',
        ]);
      
        // Habilita novamente checagem de chaves *Importante*   
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
