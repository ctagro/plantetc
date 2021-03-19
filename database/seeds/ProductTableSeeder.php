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
                   'name'           => 'Produto K',
                   'Description'    => 'Produto K',
                   'packing'        => 'Caixas',
                    'unity'         => 'ml',
                    'price'         => 100,
                    'price_unit'    => 0.1,
                   'type_product'   => 'N',
                   'note'           => '?',
                   'image'          => 'product_avatar.png',
               ]);

               Product::create([
                              
                'user_id'        => 1,
                'name'           => 'Produto X',
                'Description'    => 'Produto X',
                'packing'        => 'Sc',
                'unity'          => 'Kg',
                'price'          => 50,
                'price_unit'     => 1,
                'type_product'   => 'S',
                'note'           => '?',
                'image'          => 'product_avatar.png',
            ]);

            Product::create([
                              
                'user_id'        => 1,
                'name'           => 'Produto Y',
                'Description'    => 'Produto Y',
                'packing'        => 'Galão',
                'unity'          => 'lt',
                'price'          => 500,
                'price_unit'     => 10,
                'type_product'   => 'S',
                'note'           => '?',
                'image'          => 'product_avatar.png',
            ]);

            Product::create([
                              
                'user_id'        => 1,
                'name'           => 'Produto Z',
                'Description'    => 'Produto Z',
                'packing'        => 'Sc',
                'unity'          => 'g',
                'price'          => 1000,
                'price_unit'     => 10,
                'type_product'   => 'S',
                'note'           => '?',
                'image'          => 'product_avatar.png',
            ]);
    
               
               // Habilita novamente checagem de chaves *Importante*   
               DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
