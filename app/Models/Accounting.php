<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accounting extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'in_use' ,
        'image',
    ];

   /*********************************
     * Formatando a data como dia mes e ano
     ******************************/
     
    
    public function getDateAttribute($value)
     {
         return Carbon::parse($value)->format('d/m/Y');
     }

public function storeAccounting(array $data): Array
    {  
       //dd($data);

            $accounting = auth()->user()->accounting()->create([

                'name'          => $data['name'],
                'description'   => $data['description'],
                'in_use'        => $data['in_use'],
                'image'         => $data['image'],
                

         ]);

        
 
       if($accounting){

            DB::commit();

            return[
                'sucess' => true,
                'mensage'=> 'Funcionário registrada com sucesso'
            ];

            }

       else {

            DB::rollback();

            return[
                    'sucess' => false,
                    'mensage'=> 'Falha ao registrar a funcionário'
            ];
            }

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
