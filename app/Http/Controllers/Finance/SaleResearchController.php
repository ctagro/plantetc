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
   
    $accounts = auth()->user()->account()->where('type_account_id', '=', 3)->get();

    $grounds = auth()->user()->ground()->get();

    $bayers = auth()->user()->bayer()->get();

    $accountings = auth()->user()->accounting()->where('sale','S')->get();

    $type_accounts= type_account::where('id', '=', 3)->get();

        return view('finance.sale_research.index',compact('accounts','grounds','accountings','type_accounts','bayers'));
    }

    public function consult()

    {

        $accounts = auth()->user()->account()->where('type_account_id', '=', 3)->get();
        
        $grounds = auth()->user()->ground()->get();

        $bayers = auth()->user()->bayer()->get();

        $accountings = auth()->user()->accounting()->where('sale','S')->get();

        $type_accounts= type_account::where('id', '=', 3)->get();


    return view('finance.sale_research.research', compact('accounts','grounds','accountings','type_accounts','bayers'));

    }
    
    public function research(Request $request)
    {

       $pesquisa = $request;

        $termos = $request->only('description', 'bayer_id', 'accounting_id', 'ground_id', 'date_inicial', 'date_final' );
        $prepareQuery = "";
        $query = "";
        foreach ($termos as $nome => $valor) {

            if($valor){
              //  $query = $query . "where("."'".$nome."'".","."'"."="."'".","."'". $valor. "')->";
                if ($nome == "description")
                    $prepareQuery = $prepareQuery . $nome. ' LIKE "'. '%'.$valor.'%'. '" AND ';   
                if ($nome == "accounting_id" or $nome == "ground_id")
                    $prepareQuery = $prepareQuery . $nome. '="'. $valor. '" AND ';
                if ($nome == "date_inicial") 
                        $prepareQuery = $prepareQuery . 'date'. '>="'. $valor. '" AND ';
                if ($nome == "date_final")
                        $prepareQuery = $prepareQuery . 'date'. '<="'. $valor. '" AND ';
            
            }
         }
   
         $query = substr($prepareQuery, 0 , -5);


         if ($query)
            $accounts = account::whereRaw($query)->orderBy('date')->get();
         else
            $accounts = account::where('type_account_id', '=', 3)->orderBy('date')->get();
          
         $grounds = auth()->user()->ground()->get();

         $bayers = auth()->user()->bayer()->get();
     
         $accountings = auth()->user()->accounting()->where('sale','S')->get();

         $type_accounts= type_account::all();

 
    return view('finance.sale_research.index', compact('accounts','accountings', 'grounds','type_accounts','bayers'));
    }

}
