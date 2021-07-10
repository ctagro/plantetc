<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;use Carbon\Carbon;
use DateTime;
use DB;
use App\User;


class Category_pesticide extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'in_use' ,
    ];

   /*********************************
     * Formatando a data como dia mes e ano
     ******************************/
     
    
    public function getDateAttribute($value)
     {
         return Carbon::parse($value)->format('d/m/Y');
     }

public function storeCategory_pesticide(array $data): Array
    {  
       //dd($data);

            $category_pesticide = auth()->user()->category_pesticide()->create([

                'name'          => $data['name'],
                'description'   => $data['description'],
                'in_use'        => $data['in_use'],
                

         ]);

        
 
       if($category_pesticide){

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
