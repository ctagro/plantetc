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
        'manufacturer',
        'category_pesticide_id',
        'application',
        'active_principle_id',
        'grace_period',
        'dosage',
        'packing',
        'unity',
        'price',
        'price_unit',
        'image',
        'medicine_insert',   
        'in_use' ,
     
   
    
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
      // dd($data);

            $product = auth()->user()->pesticide()->create([

             
                'name'                  => $data['name'],
                'manufacturer'          => $data['manufacturer'],
                'category_pesticide_id' => $data['category_pesticide_id'],
                'application'           => $data['application'],
                'active_principle_id'   => $data['active_principle_id'],
                'grace_period'          => $data['grace_period'],
                'dosage'                => $data['dosage'],               
                'packing'               => $data['packing'],
                'unity'                 => $data['unity'],
                'price'                 => $data['price'],
                'price_unit'            => $data['price_unit'],
                'image'                 => $data['image'],
                'medicine_insert'       => $data['medicine_insert'],
                'in_use'                => $data['in_use'],
                
                
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

    public function active_principle()
    {
        return $this->belongsToMany(Active_principal::class);
    }

    public function category_pesticide()
    {
        return $this->belongsTo(category_pesticide::class);
    }
   
}
