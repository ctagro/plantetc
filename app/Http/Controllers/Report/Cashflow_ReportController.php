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
use App\Models\Bank;
use App\Models\CashFlow;

class Cashflow_ReportController extends Controller
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

        $cashFlows = CashFlow::all();
   
        $banks = auth()->user()->bank()->get();

        return view('report.cashflow.index',compact('banks','cashFlows'));
    }

    public function consult()

    {

        $user = auth()->user();

        if ($user['id']==1){

        $cashFlows = CashFlow::all();
   
        $banks = auth()->user()->bank()->get();

        return view('report.cashflow.research',compact('banks','cashFlows'));
        
        }  
          
        else{
        
            return view('admin.home.index');
     
        }
    }
    
    public function research(Request $request)
    {

       $pesquisa = $request;

        $termos = $request->only('bank_id','date_inicial', 'date_final' );
        $prepareQuery = "";
        $query = "";

       
        foreach ($termos as $nome => $valor) {

            if($valor){
              //  $query = $query . "where("."'".$nome."'".","."'"."="."'".","."'". $valor. "')->";
                if ($nome == "bank_id")
                    $prepareQuery = $prepareQuery . $nome. '="'. $valor. '" AND ';
                if ($nome == "date_inicial") 
                        $prepareQuery = $prepareQuery . 'date'. '>="'. $valor. '" AND ';
                if ($nome == "date_final")
                        $prepareQuery = $prepareQuery . 'date'. '<="'. $valor. '" AND ';
            
            }
         }
   
         $query = substr($prepareQuery, 0 , -5);


         if ($query){
            $cashFlows = cashFlow::whereRaw($query)->orderBy('date')->get();
         }else{
            $cashFlows = cashFlow::orderBy('date')->get();
         }
         
         $banks= Bank::all();



 
    return view('report.cashflow.index', compact('cashFlows','banks'));
    }

}
