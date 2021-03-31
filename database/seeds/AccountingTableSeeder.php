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
            'name'          => 'Mão de Obra',
            'description'   => 'Mão de obra própria',
            'in_use'        => 'S',
            'image'         => 'accounting_avatar.png',
           
        ]);

        Accounting::create([
                        
            'user_id'       => 1,
            'name'          => 'Insumos',
            'description'   => 'Insumos usado no plantio ou na condução do plantio',
            'in_use'        => 'S',
            'image'         => 'accounting_avatar.png',
           
        ]);

        Accounting::create([
                        
            'user_id'       => 1,
            'name'          => 'Comercialização',
            'description'   => 'Receita ou despesas de comercialização',
            'in_use'        => 'S',
            'image'         => 'accounting_avatar.png',
           
        ]);

        Accounting::create([
                        
            'user_id'       => 1,
            'name'          => 'Administração',
            'description'   => 'Despesas de administração',
            'in_use'        => 'S',
            'image'         => 'accounting_avatar.png',
           
        ]);

        Accounting::create([
                        
            'user_id'       => 1,
            'name'          => 'Obras',
            'description'   => 'Qualquer tipo de despesa de construção',
            'in_use'        => 'S',
            'image'         => 'accounting_avatar.png',
           
        ]);
       
          
        Accounting::create([
                        
            'user_id'       => 1,
            'name'          => 'Outras receitas ou despesas',
            'description'   => 'Despesas de administração',
            'in_use'        => 'S',
            'image'         => 'accounting_avatar.png',
           
        ]);


        // Habilita novamente checagem de chaves *Importante*   
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
