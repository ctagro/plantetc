<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
use App\Models\Pesticide;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disease extends Model
{
    use SoftDeletes;

      
    protected $fillable = [

        'user_id',
        'name_vulgar',
        'name_scientific',
        'description',
        'symptoms',
        'indicated_pesticide', 
        'control',
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

public function storeDisease(array $data): Array
    {  
       //dd($data);

            $disease = auth()->user()->disease()->create([

                
                'name_vulgar'           => $data['name_vulgar'],
                'name_scientific'       => $data['name_scientific'],
                'description'           => $data['description'],
                'symptoms'              => $data['symptoms'],
                'indicated_pesticide'   => $data['indicated_pesticide'],
                'control'               => $data['control'],
                'image'                 => $data['image'],
                'note'                  => $data['note'],           

         ]);

        
 
       if($disease){

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
