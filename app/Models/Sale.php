<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Cache\ArrayLock;
use App\Models\Type_account;
use App\Models\Worker;
use App\Models\Ground;
use App\Models\Product;
use App\Models\Account;
use App\User;
use Carbon\Carbon;
use DateTime;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;

    protected $fillable = [   
               
        'account_id'        ,
        'date'              ,
   //     'date_delivery'     ,
        'product_id'        ,
        'ground_id'         ,
        'type_account_id'      ,
        'amount'            ,
        'unity'             ,
        'price_unit'        ,
        'bayer_id'          ,
  //      'transporter_id'    ,
  //      'cost_freight'      ,
        'note'              ,

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
            
                'account_id'            => $data['account_id'],
                'date'                  => $data['date'],
 //               'date_delivery'         => $data['date_delivery'],
                'product_id'            => $data['product_id'],
                'ground_id'             => $data['ground_id'],
                'type_account_id'          => $data['type_account_id'],
                'amount'                => $data['amount'],
                'unity'                 => $data['unity'],
                'price_unit'            => $data['price_unit'],
                'bayer_id'              => $data['bayer_id'],
 //               'transporter_id'        => $data['transporter_id'],
  //              'cost_freight'          => $data['cost_freight'],
                'note'                  => $data['note'], 

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

    public function ground()
    {
        return $this->belongsTo(ground::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }

    public function account()
    {
        return $this->belongsTo(account::class);
    }

    public function bayer()
    {
        return $this->belongsTo(bayer::class);
    }

    public function type_account()
    {
        return $this->belongsTo(type_account::class);
    }
}
