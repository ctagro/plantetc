<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;

class Activity extends Model
{
   

    protected $fillable = [ 

        
        'user_id',
        'type_activities_id',
        'date',
        'product',
        'worker',
        'labor'
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

    public function storeActivity(array $data): Array
    {


 // recebe o array do controller Despesa -> storeDespesa e grava na tabela

       
            $activity = auth()->user()->activity()->create([
            
                'type_activities_id'     => $data['type_activities_id'], 
                'date'          => $data['date'],
                'product'         => $data['product'],
                'worker'         => $data['worker'],
                'labor'         => $data['labor'],

                ]);
   
       if($activity){

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

    public function type_activity()
    {
        return $this -> belongsTo(Type_activity::class);
    }

     
}


