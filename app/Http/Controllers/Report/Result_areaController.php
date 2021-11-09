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
use Redirect;

class Result_areaController extends Controller
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

        return view('report.result_area.index',compact('accounts','grounds','accountings','type_accounts'));
    }

    public function consult()

    {

        $user = auth()->user();

        

        if ($user['id']==1){


         $grounds = Ground::where('in_use', '=', "S")->get();
     
            return view('report.result_area.research', compact('grounds'));
        }

        else{
        
            return view('admin.home.index');
     
        }


    }
    
    public function research(Request $request)
    {

        $accountings= accounting::all();

     // dd($accountings);

        $pesquisa = $request;

       // dd($pesquisa);
    

    //    $termos = $request->only('ground_id', 'date_inicial', 'date_final' );

       // $prepareQuery = 'type_account_id!="2"'.'" AND ';

        $query = "";

        foreach($accountings as $accounting)
            {
                $prepareQuery ="";
                $names[] = $accounting->name;
                 $id[] = $accounting->id;


                   $prepareQuery = $prepareQuery . 'accounting_id'. '="'. $accounting->id. '" AND ';
                    if ($pesquisa['ground_id'])
                    $prepareQuery = $prepareQuery . 'ground_id'. '="'. $pesquisa['ground_id']. '" AND ';
                      if ($pesquisa['date_inicial']) 
                              $prepareQuery = $prepareQuery . 'date'. '>="'. $pesquisa['date_inicial']. '" AND ';
                      if ($pesquisa['date_final'])
                              $prepareQuery = $prepareQuery . 'date'. '<="'. $pesquisa['date_final']. '" AND ';

                    $query_account = substr($prepareQuery, 0 , -5) .' AND '.'type_account_id="1"';
                    $query_revenue = substr($prepareQuery, 0 , -5) .' AND '.'type_account_id="3"';
                
//  separando receita de despesa

                    if ($query_account){
                        $sums_account[] = DB::table('accounts')->whereRaw($query_account)->sum('amount');
                    }
                  if ($query_revenue){
                       $sums_revenue[] = DB::table('accounts')->whereRaw($query_revenue)->sum('amount');
                   }


            }

// fazendo o balanço entre despesa e receita

            for ($i=0 ; $i < count($sums_account) ; $i++){

                $sums[$i] = $sums_revenue[$i] - $sums_account[$i];

            }

     //   colocando a receita como primeiro item   

 // dd($sums_account,$sums_revenue,$names,$sums);
           
            $temp_name = $names[0];
            $temp_sum = $sums[0];

            $names[0] = $names[2];
            $sums[0] = $sums[2];

            $names[2] = $temp_name;
            $sums[2] = $temp_sum;
     // -----------------------------------------
   //  dd($names,$sums,count($sums));

            $results  =  array_combine($names,$sums);

      // dd($names,$sums,$results,$temp_name,$temp_sum);
            

         $grounds = auth()->user()->ground()->get();
     
         $accountings = auth()->user()->accounting()->get();

         $type_accounts= type_account::all();


 
    return view('report.result_area.index', compact('results'));
    }

}
