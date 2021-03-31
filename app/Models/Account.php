<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Accounting;
use App\Models\Ground;
use Carbon\Carbon;
use DateTime;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;

    protected $fillable = [ 

        
        'user_id'               ,  
        'date'                  , 
        'description'           ,      
        'type_account_id'       ,         
        'accounting_id'         ,      
        'ground_id'             ,   
        'amount'                , 
        'origin'                ,
        'note'                  ,       
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

    public function storeAccount(array $data): Array
    {
        //dd($data,$data['type']);

 // recebe o array do controller Account-> storeAccount e grava na tabela

       
            $Account = auth()->user()->Account()->create([
            
              
                'date'                  => $data['date'],
                'description'           => $data['description'],
                'type_account_id'       => $data['type_account_id'],
                'accounting_id'         => $data['accounting_id'],
                'ground_id'             => $data['ground_id'],
                'amount'                => $data['amount'],
                'origin'                => $data['origin'],
                'note'                  => $data['note'], 
                

                ]);
        
   
       if($Account){

            DB::commit();

            return[
                'sucess' => true,
                'mensage'=> 'Atividade registrada com sucesso'
            ];

            }

       else {

            DB::rollback();

            return[
                    'sucess' => false,
                    'mensage'=> 'Falha ao registrar a atividade'
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

   public function accounting()
   {
       return $this->belongsTo(accounting::class);
   }

   public function type_account()
   {
       return $this->belongsTo(type_account::class);
   }
     
}


