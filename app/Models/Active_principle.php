<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
use App\Models\Disease;
use App\Models\Pesticide;
use App\Models\category_pesticide;
use Illuminate\Database\Eloquent\SoftDeletes;

class Active_principle extends Model
{
    use SoftDeletes;
    
    protected $fillable = [

        'user_id',
        'name',
        'category_pesticide_id',
        'description',
        'main_uses',
        'note',
        'in_use',  
    ];

   /*********************************
     * Formatando a data como dia mes e ano
     ******************************/
     
    
    public function getDateAttribute($value)
     {
         return Carbon::parse($value)->format('d/m/Y');
     }

public function storeActive_principle(array $data): Array
    {  
       //dd($data);

            $active_principle = auth()->user()->active_principle()->create([

                'name'                      => $data['name'],
                'category_pesticide_id'     => $data['category_pesticide_id'],
                'description'               => $data['description'],
                'main_uses'                 => $data['main_uses'],
                'note'                      => $data['note'],
                'in_use'                    => $data['in_use'],               

         ]);

        
 
       if($active_principle){

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

    public function pesticide()
    {
        return $this->belongsToMany(Pesticide::class);
    }

    public function category_pesticide()
    {
        return $this->belongsTo(category_pesticide::class);
    }
}
