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

        $prepareQuery = 'type_account_id!="2"' . ' AND ';
        $query = "";

        foreach($accountings as $accounting)
            {
                $names[] = $accounting->name;
                 $id[] = $accounting->id;

            //     dd($names,$id);


                   $prepareQuery = $prepareQuery . 'accounting_id'. '="'. $accounting->id. '" AND ';
                    if ($pesquisa['ground_id'])
                    $prepareQuery = $prepareQuery . 'ground_id'. '="'. $pesquisa['ground_id']. '" AND ';
                      if ($pesquisa['date_inicial']) 
                              $prepareQuery = $prepareQuery . 'date'. '>="'. $pesquisa['date_inicial']. '" AND ';
                      if ($pesquisa['date_final'])
                              $prepareQuery = $prepareQuery . 'date'. '<="'. $pesquisa['date_final']. '" AND ';

                    $query1[] = substr($prepareQuery, 0 , -5);
                    $query = substr($prepareQuery, 0 , -5);
                   
                    
                
             

                    if ($query){
                        $sums[] = DB::table('accounts')->whereRaw($query)->sum('amount');
                    }else{
                        $sums[] = DB::table('accounts')->sum('amount');
                    } 

                    $prepareQuery = 'type_account_id!="2"' . ' AND ';

            }

     //   colocando a receita como primeiro item   
           
            $temp_name = $names[0];
            $temp_sum = $sums[0];

            $names[0] = $names[2];
            $sums[0] = $sums[2];

            $names[2] = $temp_name;
            $sums[2] = $temp_sum;
     // -----------------------------------------


            $results  =  array_combine($names,$sums);


      // dd($names,$sums,$results,$temp_name,$temp_sum);
            

         $grounds = auth()->user()->ground()->get();
     
         $accountings = auth()->user()->accounting()->get();

         $type_accounts= type_account::all();


 
    return view('report.result_area.index', compact('results'));
    }

}
