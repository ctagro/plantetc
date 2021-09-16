<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Type_product;
use Carbon\Carbon;
use DateTime;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entry extends Model
{
    use SoftDeletes;

    protected $fillable = [ 

        
        'user_id'            ,    
        'date'               ,
        'type_product_id'    ,
        'product_id'         ,
        'quantity'           ,
        'price_unit'         ,
        'amount'             ,
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

    public function storeEntry(array $data): Array
    {

 // recebe o array do controller Entry-> storeEntry e grava na tabela

 //dd($data);
            $Entry = auth()->user()->Entry()->create([


                'date'                 => $data['date'],
                'type_product_id'      => $data['type_product_id'],
                'product_id'           => $data['product_id'],
                'quantity'             => $data['quantity'],
                'price_unit'           => $data['price_unit'],
                'amount'               => $data['amount'],
                'note'                 => $data['note'],
                

                ]);
        
   
       if($Entry){

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
     
}
