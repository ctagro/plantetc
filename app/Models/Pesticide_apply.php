<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Pesticide_apply as Authenticatable;
use App\Models\Type_account;
use App\Models\Worker;
use App\Models\Ground;
use App\Models\Pesticide;
use App\Models\Account;
use App\Models\Accounting;
use App\User;
use Carbon\Carbon;
use DateTime;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pesticide_apply extends Model
{
    
    use SoftDeletes;

    protected $fillable = [   
               
        'account_id'            ,
        'date'                  ,
        'pesticide_id'          ,
        'worker_id'             ,
        'accounting_id'         ,
        'ground_id'             ,
        'amount'                ,
        'volume_lt'             ,
        'note'                  ,

    ];

      /*********************************
     * Formatando a data como dia mes e ano
     ******************************/
     
    
    Public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

      /*********************************
     * Registrando as despesas e os saldos
     ******************************/

    public function storePesticide_apply(array $data): Array
    { 
//dd($data);

            $pesticide_apply = auth()->user()->Pesticide_apply()->create([

                'account_id'            => $data['account_id'],
                'date'                  => $data['date'],
                'pesticide_id'          => $data['pesticide_id'],
                'worker_id'             => $data['worker_id'],
                'accounting_id'         => $data['accounting_id'],
                'ground_id'             => $data['ground_id'],          
                'amount'                => $data['amount'],
                'volume_lt'             => $data['volume_lt'],
                'note'                  => $data['note'], 

                ]);
   
       if($pesticide_apply){

            DB::commit();

            return[
                'sucess' => true,
                'mensage'=> 'Venda registrada com sucesso'
            ];

            }

       else {

            DB::rollback();

            return[
                    'sucess' => false,
                    'mensage'=> 'Falha ao registrar a venda'
            ];
            }

    }

      /*********************************
     * Registrando as relações */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ground()
    {
        return $this->belongsTo(ground::class);
    }

    public function worker()
    {
        return $this->belongsTo(worker::class);
    }

    public function account()
    {
        return $this->belongsTo(account::class);
    }

    public function accounting()
    {
        return $this->belongsTo(accounting::class);
    }

    public function type_account()
    {
        return $this->belongsTo(type_account::class);
    }

    public function pesticide()
    {
        return $this->belongsTo(pesticide::class);
    }
}
