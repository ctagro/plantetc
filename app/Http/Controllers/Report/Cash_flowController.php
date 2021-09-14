<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
use App\Models\Account;
use App\Models\Ground;
use App\Models\Accounting;
use App\Models\Type_account;

class Cash_flowController extends Controller
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
   
    $accounts = Account::all();

    $grounds = Ground::where('in_use', '=', "S")->get();

    $accountings = Accounting::where('in_use', '=', "S")->get();

    $type_accounts= type_account::all();

        return view('report.cash_flow.index',compact('accounts','grounds','accountings','type_accounts'));
    }

    public function consult()

    {

        $accounts = Account::all();

        $grounds = Ground::where('in_use', '=', "S")->get();

        $accountings = Accounting::where('in_use', '=', "S")->get();

        $type_accounts= type_account::all();


    return view('report.cash_flow.research', compact('accounts','grounds','accountings','type_accounts'));

    }
    
    public function research(Request $request)
    {

       $pesquisa = $request;

        $termos = $request->only('description', 'type_account_id', 'accounting_id', 'ground_id', 'date_inicial', 'date_final' );
        $prepareQuery = "";
        $query = "";

       
        foreach ($termos as $nome => $valor) {

            if($valor){
              //  $query = $query . "where("."'".$nome."'".","."'"."="."'".","."'". $valor. "')->";
                if ($nome == "description")
                    $prepareQuery = $prepareQuery . $nome. ' LIKE "'. '%'.$valor.'%'. '" AND ';   
                if ($nome == "type_account_id" or $nome == "accounting_id" or $nome == "ground_id")
                    $prepareQuery = $prepareQuery . $nome. '="'. $valor. '" AND ';
                if ($nome == "date_inicial") 
                        $prepareQuery = $prepareQuery . 'date'. '>="'. $valor. '" AND ';
                if ($nome == "date_final")
                        $prepareQuery = $prepareQuery . 'date'. '<="'. $valor. '" AND ';
            
            }
         }
   
         $query = substr($prepareQuery, 0 , -5);


         if ($query){
            $accounts = account::whereRaw($query)->orderBy('date')->get();
         }else{
            $accounts = account::orderBy('date')->get();
         }
         
         $grounds = auth()->user()->ground()->get();
     
         $accountings = auth()->user()->accounting()->get();

         $type_accounts= type_account::all();


 
    return view('report.cash_flow.index', compact('accounts','grounds','type_accounts','accountings',));
    }

}
