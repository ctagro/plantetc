<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductTableSeeder extends Seeder
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
               DB::table('products')->delete();
       
               
               Product::create([
                              
                   'user_id'        => 1,
                   'name'           => 'Adubo Foliar',
                   'Description'    => 'Adubo Foliar',
                   'type_product'   => '?',
                   'note'           => '?',
                   'image'          => 'product_avatar.png',
               ]);

               Product::create([
                              
                'user_id'        => 1,
                'name'           => 'Produto X',
                'Description'    => 'Produto X',
                'type_product'   => '?',
                'note'           => '?',
                'image'          => 'product_avatar.png',
            ]);

            Product::create([
                              
                'user_id'        => 1,
                'name'           => 'Produto Y',
                'Description'    => 'Produto Y',
                'type_product'   => '?',
                'note'           => '?',
                'image'          => 'product_avatar.png',
            ]);

            Product::create([
                              
                'user_id'        => 1,
                'name'           => 'Produto Z',
                'Description'    => 'Produto Z',
                'type_product'   => '?',
                'note'           => '?',
                'image'          => 'product_avatar.png',
            ]);
    
               
               // Habilita novamente checagem de chaves *Importante*   
               DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
