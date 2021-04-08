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
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       // $user = auth()->user();

        $accounts = Account::all();

        $sales = Sale::all();

        $grounds = Ground::where('in_use', '=', "S")->get();

        $bayers = Bayer::where('in_use', '=', "S")->get();

        $crops = Crop::where('in_use', '=', "S")->get();

        $type_accounts = Type_account::all();

        $accountings = Accounting::where('in_use', '=', "S")->get();

        $type_accounts= type_account::all();

        return view('finance.sale_research.index',compact('sales','accounts','grounds','accountings','type_accounts','bayers','crops'));
    }

    public function consult()

    {

        $accounts = Account::all();

        $sales = Sale::all();

        $grounds = Ground::where('in_use', '=', "S")->get();

        $bayers = Bayer::where('in_use', '=', "S")->get();

        $crops = Crop::where('in_use', '=', "S")->get();

        $type_accounts = Type_account::all();

        $accountings = Accounting::where('in_use', '=', "S")->get();

        $type_accounts= type_account::all();


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

         dd($query);


         if ($query)
            $sales = sale::whereRaw($query)->orderBy('date')->get();
         else
            $sales = sale::orderBy('date')->get();

            $accounts = Account::all();
          
            $grounds = Ground::where('in_use', '=', "S")->get();

            $bayers = Bayer::where('in_use', '=', "S")->get();
    
            $crops = Crop::where('in_use', '=', "S")->get();
    
            $type_accounts = Type_account::all();
    
            $accountings = Accounting::where('in_use', '=', "S")->get();


        
        // dd($sales); 


    return view('finance.sale_research.index', compact('sales','crops','grounds','bayers','accounts'));
    }

}
