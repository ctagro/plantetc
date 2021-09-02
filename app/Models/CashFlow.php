<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Bank;
use Carbon\Carbon;
use DateTime;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashFlow extends Model
{
    use SoftDeletes;

    protected $fillable = [ 

        
        'user_id'               ,  
        'date'                  , 
        'description'           ,      
        'bank_id'               ,   
        'amount'                , 
        'balance'               ,
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

    public function storeCashFlow(array $data): Array
    {
        //dd($data,$data['type']);

 // recebe o array do controller CashFlow-> storeCashFlow e grava na tabela

       
            $CashFlow = auth()->user()->CashFlow()->create([
            
              
                'date'                  => $data['date'],
                'description'           => $data['description'],
                'bank_id'               => $data['bank_id'],
                'amount'                => $data['amount'],
                'balance'               => $data['balance'],
                'note'                  => $data['note'], 
                

                ]);
        
   
       if($CashFlow){

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

    public function bank()
   {
       return $this->belongsTo(bank::class);
   }

}
