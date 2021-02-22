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
        'description',
        'active',
        'image',
        'note'
    
];

public function storetype_activity(array $data): Array
    {

        //dd($data);

            $type_activity = auth()->user()->Type_activity()->create([         
                
            
                'description'    => $data['description'],
                'active'         => $data['active'],
                'image'          => $data['image'],
                'note'           => $data['note']

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
