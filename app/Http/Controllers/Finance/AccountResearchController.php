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
   
    $accounts = auth()->user()->account()->get();

    $grounds = auth()->user()->ground()->get();

    $accountings = auth()->user()->accounting()->get();

        return view('finance.account_research.index',compact('accounts','grounds','accountings'));
    }

    public function consult()

    {

        $accounts = auth()->user()->account()->get();

        $grounds = auth()->user()->ground()->get();

        $accountings = auth()->user()->accounting()->get();

    return view('finance.account_research.research', compact('accounts','grounds','accountings'));

    }
    
    public function research(Request $request)
    {

       $pesquisa = $request;


        $termos = $request->only('description', 'type', 'accounting_id', 'ground_id', 'date_inicial', 'date_final' );
        $prepareQuery = "";
        $query = "";
        foreach ($termos as $nome => $valor) {

            if($valor){
              //  $query = $query . "where("."'".$nome."'".","."'"."="."'".","."'". $valor. "')->";
                if ($nome == "description")
                    $prepareQuery = $prepareQuery . $nome. ' LIKE "'. '%'.$valor.'%'. '" AND ';   
                if ($nome == "type" or $nome == "accounting_id" or $nome == "ground_id")
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
         $accounts = account::orderBy('date')->get();
          
    $accountings = accounting::all();

    $grounds = ground::all();

    $users = user::all();
 
    return view('finance.account_research.index', compact('accounts','accountings', 'grounds', 'users'));
    }

}
