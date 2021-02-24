<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;

class Worker extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'admission',
        'salary'
    
];

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

   

public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
