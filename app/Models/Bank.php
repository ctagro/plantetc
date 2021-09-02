<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;use App\Models\CashFlow;

use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'in_use' ,
        'note'
    
];

public function storebank(array $data): Array
    {

        //dd($data);

            $bank = auth()->user()->Bank()->create([         
                
            
                'name'              => $data['name'],
                'in_use'            => $data['in_use'],
                'note'              => $data['note']

            ]);

 
       if($bank){

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

    public function cashFlow()
   {
       return $this->belongsTo(cashFlow::class);
   }

}
