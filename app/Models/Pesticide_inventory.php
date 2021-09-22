<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Pesticide;
use App\Models\Provide;
use App\Models\Type_product;
use App\Models\Status_inventory;
use Carbon\Carbon;
use DateTime;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pesticide_inventory extends Model
{
    use SoftDeletes;

    protected $fillable = [   
               
        'date'                  ,
        'type_product_id'       ,
        'pesticide_id'            ,
        'provide_id'            ,
        'entry'                 ,
        'exit'                  ,
        'balance'               ,
        'minimum_stock'         ,
        'status'                ,
        'note'                  ,

    ];

      /*********************************
     * Formatando a data como dia mes e ano
     ******************************/
     
    
    Public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

      /*********************************
     * Registrando as despesas e os saldos
     ******************************/

    public function storePesticide_inventory(array $data): Array
    {
       

 // recebe o array do controller Despesa -> storeDespesa e grava na tabela

       
            $fertilizer_inventory = auth()->user()->Pesticide_inventory()->create([
       
                
                'date'              => $data['date'],
                'type_product_id'   => $data['type_product_id'],
                'provide_id'        => $data['provide_id'],
                'pesticide_id'        => $data['pesticide_id'],
                'entry'             => $data['entry'],
                'exit'              => $data['exit'],
                'balance'           => $data['balance'],
                'minimum_stock'     => $data['minimum_stock'],
                'status'            => $data['status'],
                'note'              => $data['note'],

                ]);
        
   
       if($fertilizer_inventory){

            DB::commit();

            return[
                'sucess' => true,
                'mensage'=> 'Venda registrada com sucesso'
            ];

            }

       else {

            DB::rollback();

            return[
                    'sucess' => false,
                    'mensage'=> 'Falha ao registrar a venda'
            ];
            }

    }

      /*********************************
     * Registrando as relações */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pesticide()
    {
        return $this->belongsTo(pesticide::class);
    }

    public function type_product()
    {
        return $this->belongsTo(type_product::class);
    }

    public function provide()
    {
        return $this->belongsTo(provide::class);
    }

    public function status_inventory()
   {
       return $this->belongsTo(status_inventory::class);
   }
}
