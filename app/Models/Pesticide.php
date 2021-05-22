<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Pesticide as Authenticatable;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pesticide extends Model
{

    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'type_pesticide',
        'active_principle',
        'carencia',
        'dosagem',
        'indicacoes',
        'packing',
        'unity',
        'manufacturer',
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

public function storePesticide(array $data): Array
    {  
       //dd($data);

            $product = auth()->user()->pesticide()->create([

                'name'              => $data['name'],
                'description'       => $data['description'],
                'active_principle'  => $data['active_principle'],
                'carencia'          => $data['carencia'],
                'dosagem'           => $data['dosagem'],
                'indicacoes'        => $data['indicacoes'],
                'type_pesticide'    => $data['type_pesticide'],
                'packing'           => $data['packing'],
                'unity'             => $data['unity'],
                'manufacturer'      => $data['manufacturer'],
                'price'             => $data['price'],
                'price_unit'        => $data['price_unit'],
                'in_use'            => $data['in_use'],
                'note'              => $data['note'],
                'image'             => $data['image'],
                
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
