<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Cache\ArrayLock;
use App\Models\Type_activity;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;

class Activity extends Model
{
   

    protected $fillable = [ 

        
        'user_id'               ,  
        'type_activities_id'    ,        
        'date'                  , 
        'crop'                  ,   
        'product'               ,      
        'worker'                ,      
        'start_time'            ,       
        'final_time'            ,         
        'worked_hours'          ,         
        'active'                ,        
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

    public function storeActivity(array $data): Array
    {
        //dd($data,$data['type_activity_id']);

 // recebe o array do controller Despesa -> storeDespesa e grava na tabela

       
            $activity = auth()->user()->Activity()->create([
            

                'type_activities_id'    => $data['type_activities_id'],
                'date'                  => $data['date'],
                'crop'                  => $data['crop'],
                'product'               => $data['product'],
                'worker'                => $data['worker'],
                'start_time'            => $data['start_time'],
                'final_time'            => $data['final_time'],
                'worked_hours'          => $data['worked_hours'],
                'active'                => $data['active'],
                'note'                  => $data['note'],  

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


