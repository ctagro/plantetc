<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bayer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'in_use' ,
        'image',
        'note'
    
];

public function storebayer(array $data): Array
    {

        //dd($data);

            $bayer = auth()->user()->Bayer()->create([         
                
            
                'name'              => $data['name'],
                'in_use'            => $data['in_use'],
                'image'             => $data['image'],
                'note'              => $data['note']

            ]);

 
       if($bayer){

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
