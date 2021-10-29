<?php

namespace App\Models;
Use App\User;
use App\Models\Type_product;
use App\Models\Provide;
use Carbon\Carbon;
use DateTime;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Pesticide_entry extends Model
{
    use SoftDeletes;

    protected $fillable = [ 

        
        'user_id'            ,    
        'date'               ,
        'type_product_id'    ,
        'pesticide_id'       ,
        'provide_id'         ,
        'quantity'           ,
        'price_unit'         ,
        'amount'             ,
        'quantity_cons'      ,
        'price_unit_cons'    ,
        'note'               ,
    ];

      /*********************************
     * Formatando a data como dia mes e ano
     ******************************/
     
    
    public function getDateAttribute($value)
     {
         return Carbon::parse($value)->format('d/m/Y');
     }


      /*********************************
     * Registrando as despesas e os saldos
     ******************************/

    public function storePesticide_entry(array $data): Array
    {

 // recebe o array do controller Pesticide_entry-> storePesticide_entry e grava na tabela

            $Pesticide_entry = auth()->user()->Pesticide_entry()->create([

                'date'                 => $data['date'],
                'type_product_id'      => $data['type_product_id'],
                'pesticide_id'         => $data['pesticide_id'],
                'provide_id'           => $data['provide_id'],
                'quantity'             => $data['quantity'],
                'price_unit'           => $data['price_unit'],
                'amount'               => $data['amount'],
                'quantity_cons'        => $data['quantity_cons'],
                'price_unit_cons'      => $data['price_unit_cons'],
                'note'                 => $data['note'],
                

                ]);
        
   
       if($Pesticide_entry){

            DB::commit();

            return[
                'sucess' => true,
                'mensage'=> 'Entrada no estoque registrada com sucesso'
            ];

            }

       else {

            DB::rollback();

            return[
                    'sucess' => false,
                    'mensage'=> 'Falha ao registrar entrada no estoque'
            ];
            
            }

    }

      /*********************************
     * Registrando as relações */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   public function type_product()
   {
       return $this->belongsTo(type_product::class);
   }

   public function pesticide()
   {
       return $this->belongsTo(pesticide::class);
   }

   public function provide()
   {
       return $this->belongsTo(provide::class);
   }

}
