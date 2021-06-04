<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'type_product',
        'packing',
        'unity',
        'price',
        'price_unit',
        'in_use' ,
        'note',
        'image',
    
];

   /*********************************
     * Formatando a data como dia mes e ano
     ******************************/
     
    
    public function getDateAttribute($value)
     {
         return Carbon::parse($value)->format('d/m/Y');
     }

public function storeProduct(array $data): Array
    {  
       //dd($data);

            $product = auth()->user()->product()->create([

                'name'          => $data['name'],
                'description'   => $data['description'],
                'type_product'  => $data['type_product'],
                'packing'       => $data['packing'],
                'unity'         => $data['unity'],
                'price'         => $data['price'],
                'price_unit'    => $data['price_unit'],
                'in_use'         => $data['in_use'],
                'note'          => $data['note'],
                'image'         => $data['image'],
                

         ]);

        
 
       if($product){

            DB::commit();

            return[
                'sucess' => true,
                'mensage'=> 'Produto registrada com sucesso'
            ];

            }

       else {

            DB::rollback();

            return[
                    'sucess' => false,
                    'mensage'=> 'Falha ao registrar o produto'
            ];
            }

    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
