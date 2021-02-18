<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;

class Type_activity extends Model
{
    protected $fillable = [
        'user_id',
        'code',
        'description',
        'in_uso',
        'note'
    
];

public function storetype_activity(array $data): Array
    {

            $type_activity = auth()->user()->type_activity()->create([
               
               
                'code'            => $data['code'],
                'description'     => $data['description'],
                'in_uso'          => $data['in_uso'],
                'note'          => $data['note']

         ]);

 
       if($type_activity){

            DB::commit();

            return[
                'sucess' => true,
                'mensage'=> 'Tipo de atividade registrada com sucesso'
            ];

            }

       else {

            DB::rollback();

            return[
                    'sucess' => false,
                    'mensage'=> 'Falha ao registrar do tipo de atividade'
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
