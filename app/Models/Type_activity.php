<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type_activity extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'description',
        'image',
        'note',
        'in_use'
    
];

public function storetype_activity(array $data): Array
    {

        //dd($data);

            $type_activity = auth()->user()->Type_activity()->create([         
                
            
                'description'    => $data['description'],
                'image'          => $data['image'],
                'note'           => $data['note'],
                'in_use'         => $data['in_use'],

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



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
