<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
use App\Models\Entry;
use Illuminate\Database\Eloquent\SoftDeletes;


class Type_product extends Model
{

    protected $fillable = [
        'user_id',
        'name',
        'in_use' ,
        'note'
    
];

public function storetype_product(array $data): Array
    {

        //dd($data);

            $type_product = auth()->user()->Type_product()->create([         
                
            
                'name'              => $data['name'],
                'in_use'            => $data['in_use'],
                'note'              => $data['note']

            ]);

 
       if($type_product){

            DB::commit();

            return[
                'sucess' => true,
                'mensage'=> 'Tipo de produto registrada com sucesso'
            ];

            }

       else {

            DB::rollback();

            return[
                    'sucess' => false,
                    'mensage'=> 'Falha ao registrar do tipo de produto'
            ];
            }

    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function entry()
   {
       return $this->belongsTo(Entry::class);
   }
}
