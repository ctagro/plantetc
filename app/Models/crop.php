<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Crop extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'packing',
        'unity',    
        'image',
        'note',
    
];

   /*********************************
     * Formatando a data como dia mes e ano
     ******************************/
     
    
    public function getDateAttribute($value)
     {
         return Carbon::parse($value)->format('d/m/Y');
     }

public function storeCrop(array $data): Array
    {  
       //dd($data);

            $crop = auth()->user()->crop()->create([

                'name'          => $data['name'],
                'description'   => $data['description'], 
                'packing'       => $data['packing'],
                'unity'         => $data['unity'],
                'image'         => $data['image'],
                'note'          => $data['note'],
                

         ]);

        
 
       if($crop){

            DB::commit();

            return[
                'sucess' => true,
                'mensage'=> 'Cultura registrada com sucesso'
            ];

            }

       else {

            DB::rollback();

            return[
                    'sucess' => false,
                    'mensage'=> 'Falha ao registrar a Cultura'
            ];
            }

    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
