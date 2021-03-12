<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'name',
        'date',
        'salary',
        'salary_hour',
        'image',
    
];

   /*********************************
     * Formatando a data como dia mes e ano
     ******************************/
     
    
    public function getDateAttribute($value)
     {
         return Carbon::parse($value)->format('d/m/Y');
     }

public function storeWorker(array $data): Array
    {  
       //dd($data);

            $worker = auth()->user()->worker()->create([

                'name'          => $data['name'],
                'date'          => $data['date'],
                'salary'        => $data['salary'],
                'salary_hour'   => $data['salary'],
                'image'         => $data['image'],
                

         ]);

        
 
       if($worker){

            DB::commit();

            return[
                'sucess' => true,
                'mensage'=> 'Funcionário registrada com sucesso'
            ];

            }

       else {

            DB::rollback();

            return[
                    'sucess' => false,
                    'mensage'=> 'Falha ao registrar a funcionário'
            ];
            }

    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
