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
            'name'          => 'Venda',
            'description'   => 'Hotifruti produzido na Fazenda ',
            'in_use'        => 'S',
            'image'         => 'accounting_avatar.png',
            'sale'          => 'S',
        ]);

         Accounting::create([
                       
            'user_id'       => 1,
            'name'          => 'Colheita',
            'description'   => 'Colheita de qualquer hortifruti',
            'in_use'        => 'S',
            'image'         => 'accounting_avatar.png',
            'sale'          => 'N',
        ]);

        Accounting::create([
                       
            'user_id'       => 1,
            'name'          => 'Adubação',
            'description'   => 'Adubação via solo ou foliar',
            'in_use'        => 'S',
            'image'         => 'accounting_avatar.png',
            'sale'          => 'P',
        ]);

        Accounting::create([
                       
            'user_id'       => 1,
            'name'          => 'Controle de pragas',
            'description'   => 'Aplicação de qualquer produto para controle de pragas ou ervas daninhas',
            'in_use'        => 'S',
            'image'         => 'accounting_avatar.png',
            'sale'          => 'N',
        ]);

       Accounting::create([
                       
            'user_id'       => 1,
            'name'          => 'Atividades Gerais',
            'description'   => 'Exemplo limpeza, capina, etc',
            'in_use'        => 'S',
            'image'         => 'accounting_avatar.png',
            'sale'          => 'N',
        ]);

        Accounting::create([
                       
            'user_id'       => 1,
            'name'          => 'Mudas e sementes',
            'description'   => 'Mudas e sementes de qualquer natureza',
            'in_use'        => 'S',
            'image'         => 'accounting_avatar.png',
            'sale'          => 'N',
        ]);

      
        // Habilita novamente checagem de chaves *Importante*   
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
