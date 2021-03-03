<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;
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
        'admission',
        'salary'
    
];

public function getDateAttribute($value)
     {
         return Carbon::parse($value)->format('d/m/Y');
     }

public function storeWorker(array $data): Array
    {  
       //dd($data);

            $worker = auth()->user()->worker()->create([

                'name'          => $data['name'],
                'admission'     => $data['admission'],
                'salary'        => $data['salary'],
                

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
