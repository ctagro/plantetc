<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
Use App\Models\Worker;
Use App\Models\Ground;
use Illuminate\Database\Eloquent\SoftDeletes;

class Greenhouse_report extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'date',
        'worker_id', 
        'ground_id',
        'note' ,
        'image',
    
];

   /*********************************
     * Formatando a data como dia mes e ano
     ******************************/
     
    
    public function getDateAttribute($value)
     {
         return Carbon::parse($value)->format('d/m/Y');
     }

public function storeGreenhouse_report(array $data): Array
    {  
       //dd($data);

            $greenhouse_report = Greenhouse_report::create([

                'user_id'          => $data['user_id'],
                'date'          => $data['date'],
                'worker_id'     => $data['worker_id'],
                'ground_id'     => $data['ground_id'],
                'note'        => $data['note'],
                'image'         => $data['image'],
                

         ]);

        
 
       if($greenhouse_report){

            DB::commit();

            return[
                'sucess' => true,
                'mensage'=> 'Area registrada com sucesso'
            ];

            }

       else {

            DB::rollback();

            return[
                    'sucess' => false,
                    'mensage'=> 'Falha ao registrar a Area'
            ];
            }

    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function worker()
    {
        return $this->belongsTo(worker::class);
    }

    public function ground()
    {
        return $this->belongsTo(ground::class);
    }
}
