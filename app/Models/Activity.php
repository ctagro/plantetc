<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Cache\ArrayLock;
use App\Models\Type_activity;
use App\Models\Worker;
use App\User;
use Carbon\Carbon;
use DateTime;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
   use SoftDeletes;

    protected $fillable = [ 

        
       
        'type_activity_id'    ,        
        'date'                  , 
        'crop'                  ,   
        'product'               ,      
        'worker_id'                ,      
        'start_time'            ,       
        'final_time'            ,         
        'worked_hours'          ,         
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

    public function storeActivity(array $data): Array
    {
       

 // recebe o array do controller Despesa -> storeDespesa e grava na tabela

       
            $activity = auth()->user()->Activity()->create([
            
                
            
                'date'                  => $data['date'],
                'crop'                  => $data['crop'],
                'product'               => $data['product'],
                'worker_id'             => $data['worker_id'],
                'start_time'            => $data['start_time'],
                'final_time'            => $data['final_time'],
                'worked_hours'          => $data['worked_hours'],
                'note'                  => $data['note'],  
                'type_activity_id'      => $data['type_activity_id']

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
        return $this->belongsTo(Type_activity::class);
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    

     
}


