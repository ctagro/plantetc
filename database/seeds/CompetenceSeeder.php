<?php

use Illuminate\Database\Seeder;
use App\Models\Competence;

class CompetenceSeeder extends Seeder

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
       DB::table('competences')->delete();

       
       Competence::create([
                      
           
           'name'           => 'Administrador',
           'description'    => 'Acesso a todas as funcionalidades',
         
    ]);

       Competence::create([
                      
           
           'name'           => 'Nível 1',
           'description'    => 'Ler e escrever os seus dados e acesso a alguns relatórios gerais',
          
    ]);


       Competence::create([
                      
          
          'name'           => 'Nível 2',
          'description'    => 'Ler, escrever e acessar os seus dados',
    ]);

      Competence::create([
                      
          
        'name'              => 'Nível 3',
        'description'       => 'Acesso apenas aos dados abertos',
   
    ]);
       
       // Habilita novamente checagem de chaves *Importante*   
       DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
