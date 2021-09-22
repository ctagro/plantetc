<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_inventory extends Model
{
    use SoftDeletes;

    protected $fillable = [   
               
        'date'                  ,
        'type_product_id'       ,
        'product_id'            ,
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

    public function storeSale(array $data): Array
    {
       

 // recebe o array do controller Despesa -> storeDespesa e grava na tabela

       
            $sale = auth()->user()->Sale()->create([
       
                
                'date'              => $data['date'],
                'type_product_id'   => $data['type_product_id'],
                'provide_id'        => $data['provide_id'],
                'product_id'        => $data['product_id'],
                'entry'             => $data['entry'],
                'exit'              => $data['exit'],
                'balance'           => $data['balance'],
                'minimum_stock'     => $data['minimum_stock'],
                'status'            => $data['status'],
                'note'              => $data['note'],

                ]);
        
   
       if($sale){

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

    public function product()
    {
        return $this->belongsTo(product::class);
    }

    public function type_product()
    {
        return $this->belongsTo(type_product::class);
    }

    public function provide()
    {
        return $this->belongsTo(provide::class);
    }
}
