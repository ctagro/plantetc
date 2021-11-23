<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
Use App\Import\PriceCeasaImport;
use Carbon\Carbon;
use DateTime;
use DB;

class PriceCeasaBh extends Model
{
    protected $fillable = [
        'date',
        'product',
        'embalagem',
        'price_min',
        'price_com',
        'price_max',
        'situation',
    ];


public function getDateAttribute($value)
{
    return Carbon::parse($value)->format('d/m/Y');
}

public function storePriceCeasa(array $data): Array
{  
 // dd($data);

       $priceCeasa = PriceCeasaBh()->create([

                'date'          =>      $data['date'],       
                'product'       =>      $data['product'],    
                'embalagem'     =>      $data['embalagem'],  
                'price_min'     =>      $data['price_min'],  
                'price_com'     =>      $data['price_com'],  
                'price_max'     =>      $data['price_max'],  
                'situation'     =>      $data['situation'],         
           
                ]);
  }
}
