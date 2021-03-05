<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
use App\Models\Ground;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ground extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'name',
        'area',
        'location',
        'image',
    
];

   /*********************************
     * Formatando a data como dia mes e ano
     ******************************/
     
    
    public function getDateAttribute($value)
     {
         return Carbon::parse($value)->format('d/m/Y');
     }

public function storeGround(array $data): Array
    {  
       //dd($data);

            $ground = auth()->user()->ground()->create([

                'name'          => $data['name'],
                'area'          => $data['area'],
                'location'        => $data['location'],
                'image'          => $data['image'],
                

         ]);

        
 
       if($ground){

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
}
