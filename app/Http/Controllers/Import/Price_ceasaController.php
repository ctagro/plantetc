<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Models\Price_ceasa_bh;
use App\Http\Requests\ImportRequest;
use App\Import\PriceCeasaImport;
use Illuminate\Support\Facades\Schema;
use App\Report\CustomerReport;
use Exception;
use Illuminate\Database\SchemaBuilder;
Use League\Csv\Reader;
Use League\Csv\Writer;
Use League\Csv\Statement;



class Price_ceasaController extends Controller
{
    
    protected $priceCeasa_import;
    

    public function __construct(
                                PriceCeasaImport $priceCeasa_import
                                )
    {
       
        $this->priceCeasa_import = $priceCeasa_import;

    }

    public function import()
    {
        return view('import.ceasaBH.form');
    }


    public function storeImport(Request $request)
    {
        // Criar deste de consistência de leitura do arquivo

        $date = $request['date'];
        $response = $this->priceCeasa_import->allData($request);

       // dd($date);

        $cotacoes = Price_ceasa_bh::where('date', '=', $date)->orderBy('date')->get();           
       
       //  dd($cotacoes[2]);

        
      //  return redirect()->route('ceasa.index',[$date]);  
    return view('import.ceasaBH.index',compact('cotacoes')); 
    }

    public function index($date)
    {
        

    //   dd($date);
    
        $cotacoes = Price_ceasa_bh::whereRaw('date = $date')->orderBy('date')->get();           
       
  //       dd($cotacoes);
       

        return view('import.ceasaBH.index',compact('cotacoes'));
    }

    public function edit($import) {



        return view('import.ceasaBH.edit',['import' => $import]);
    }


}
