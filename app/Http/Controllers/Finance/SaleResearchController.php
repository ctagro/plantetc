<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
use App\Models\Account;
use App\Models\Accounting;
use App\Models\Ground;
use App\Models\Crop;
use App\Models\Sale;

use App\Models\Bayer;
use App\Models\Type_account;


class SaleResearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = auth()->user();

        $accounts = auth()->user()->account()->get();

        $sales = auth()->user()->sale()->get();

        $bayers = auth()->user()->bayer()->get();

        $grounds = auth()->user()->ground()->get();

        $crops = auth()->user()->crop()->get();

        $type_accounts = Type_account::all();

        $accountings = auth()->user()->accounting()->where('sale','S')->get();

        $type_accounts= type_account::where('id', '=', 3)->get();

        return view('finance.sale_research.index',compact('sales','accounts','grounds','accountings','type_accounts','bayers','crops'));
    }

    public function consult()

    {

        $accounts = auth()->user()->account()->get();

        $sales = auth()->user()->sale()->get();

        $grounds = auth()->user()->ground()->get();

        $crops = auth()->user()->crop()->get();

        $bayers = auth()->user()->bayer()->get();

        $type_accounts = Type_account::all();

        $accountings = auth()->user()->accounting()->where('sale','S')->get();

        $type_accounts= type_account::where('id', '=', 3)->get();


    return view('finance.sale_research.research', compact('sales','accounts','accountings','grounds','type_accounts','bayers','crops'));

    }
    
    public function research(Request $request)
    {

       $pesquisa = $request;

       //dd($pesquisa);

        $termos = $request->only('bayer_id','crop_id', 'ground_id', 'date_inicial', 'date_final' );
        $prepareQuery = "";
        $query = "";
        foreach ($termos as $nome => $valor) {

            if($valor){
              //  $query = $query . "where("."'".$nome."'".","."'"."="."'".","."'". $valor. "')->";
                if ($nome == "bayer_id" or $nome == "crop_id" or $nome == "ground_id")
                    $prepareQuery = $prepareQuery . $nome. '="'. $valor. '" AND ';
                if ($nome == "date_inicial") 
                        $prepareQuery = $prepareQuery . 'date'. '>="'. $valor. '" AND ';
                if ($nome == "date_final")
                        $prepareQuery = $prepareQuery . 'date'. '<="'. $valor. '" AND ';
            
            }
         }
   
        // dd($prepareQuery);

         $query = substr($prepareQuery, 0 , -5);

         //dd($query);


         if ($query)
            $sales = sale::whereRaw($query)->orderBy('date')->get();
         else
            $sales = sale::orderBy('date')->get();
          
        $bayers = auth()->user()->bayer()->get();

        $crops = auth()->user()->crop()->get();
         
        $grounds = auth()->user()->ground()->get();

        $accounts = auth()->user()->account()->get();
     
        $accountings = auth()->user()->accounting()->where('sale','S')->get();

        $type_accounts= type_account::all();

        
        // dd($sales); 


    return view('finance.sale_research.index', compact('sales','crops','grounds','bayers','accounts'));
    }

}
