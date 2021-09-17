<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provide extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'adress',
        'city',
        'province',
        'phone',
        'salesman',
        'image',
        'note',
        'in_use',
    
];


public function storeprovide(array $data): Array
    {

        //dd($data);

            $provide = auth()->user()->Provide()->create([         
                
            
                'name'              => $data['name'],
                'adress'            => $data['adress'],
                'city'              => $data['city'],
                'province'          => $data['province'],
                'phone'             => $data['phone'],
                'salesman'          => $data['salesman'], 
                'in_use'            => $data['in_use'],
                'image'             => $data['image'],
                'note'              => $data['note']

            ]);

 
       if($provide){

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


