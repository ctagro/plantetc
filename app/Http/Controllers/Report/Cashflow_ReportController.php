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
       // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
   
        $user = auth()->user();


        $cashFlows = auth()->user()->cashFlow()->orderBy('date')->get();
    
            $banks = Bank::all();

            return view('report.cashflow.index',compact('banks','cashFlows'));

        }
    

    public function consult()

    {

        $user = auth()->user();

        // Programei o limite de 


        if ($user['id']<10){

            $cashFlows = auth()->user()->cashFlow()->orderBy('date')->get();
   
        $banks = Bank::all();

        return view('report.cashflow.research',compact('banks','cashFlows'));
        
        }  
          
        else{
        
            return view('admin.home.index');
     
        }

    }
    
    public function research(Request $request)
    {

       $pesquisa = $request;

       $user = auth()->user();
      $user_id = $user['id'];
     // DD($user_id);

        $termos = $request->only('description','bank_id','date_inicial', 'date_final' );
        if($user_id == 1) {
            $prepareQuery = "";}
        else{
            $prepareQuery = 'user_id ' . ' = "' .  $user_id .  '" AND ';
        }
   
    //    $prepareQuery = "";
        $query = "";
      //  dd($prepareQuery);

       
        foreach ($termos as $nome => $valor) {

            if($valor){
              //  $query = $query . "where("."'".$nome."'".","."'"."="."'".","."'". $valor. "')->";
              if ($nome == "description")
                    $prepareQuery = $prepareQuery . $nome. ' LIKE "'. '%'.$valor.'%'. '" AND '; 
              if ($nome == "bank_id")
                    $prepareQuery = $prepareQuery . $nome. '="'. $valor. '" AND ';
                if ($nome == "date_inicial") 
                    $prepareQuery = $prepareQuery . 'date'. '>="'. $valor. '" AND ';
                if ($nome == "date_final")
                    $prepareQuery = $prepareQuery . 'date'. '<="'. $valor. '" AND ';
            }
         }
  // dd($prepareQuery);
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
