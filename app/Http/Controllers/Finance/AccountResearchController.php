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
use App\Models\Type_account;


class AccountResearchController extends Controller
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
   
    $accounts = auth()->user()->account()->where('origin', '=', "C")->get();

    $grounds = Ground::where('in_use', '=', "S")->get();

    $accountings = Accounting::where('in_use', '=', "S")->get();


    $type_accounts= type_account::all();


        return view('finance.account_research.index',compact('accounts','grounds','accountings','type_accounts'));
    }

    public function consult()

    {

        $accounts = auth()->user()->account()->where('type_account_id', '<=', 2)->where('origin', '=', "C")->get();
        
        $grounds = Ground::where('in_use', '=', "S")->get();

        $accountings = Accounting::where('in_use', '=', "S")->get();

        $type_accounts= type_account::all();


    return view('finance.account_research.research', compact('accounts','grounds','accountings','type_accounts'));

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

       $prepareQuery = $prepareQuery. 'origin'. '!="'. "P" . '" AND ' .'origin'. '!="'. "A". '" AND ';
   
         $query = substr($prepareQuery, 0 , -5);

//         dd($query);

 //        if ($query)
            $accounts = account::whereRaw($query)->orderBy('date')->get();
//            $accounts = account::where('origin', '=', "C")->orderBy('date')->get();
 //        else
//            $accounts = account::where('origin', '=', "C")->orderBy('date')->get();
          
         $grounds = Ground::where('in_use', '=', "S")->get();
     
         $accountings = Accounting::where('in_use', '=', "S")->get();;

         $type_accounts= type_account::all();

 
    return view('finance.account_research.index', compact('accounts','accountings', 'grounds','type_accounts'));
    }

}
