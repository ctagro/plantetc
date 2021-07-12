<?php

namespace App\Http\Controllers\Pesticide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
use App\Models\Pesticide_apply;
use App\Models\Worker;
use App\Models\Account;
use App\Models\Accounting;
use App\Models\Ground;
use App\Models\Pesticide;

class Pesticide_applyResearchController extends Controller
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
   
    $pesticide_applys = Pesticide_apply::all();

    $grounds = Ground::where('in_use', '=', "S")->get();

    $bayers = Bayer::where('in_use', '=', "S")->orderby('name','asc')->get();

    $accounts = auth()->user()->account()->get();

    $accountings = Accounting::where('in_use', '=', "S")->get();

    $workers = Worker::where('in_use', '=', "S")->orderby('name','asc')->get();

    $pesticides = Pesticide::where('in_use', '=', "S")->orderby('name','asc')->get();

        return view('Pesticide/Pesticide_apply.Pesticide_apply_research.index',compact('pesticide_applys','accounts','accountings','grounds','workers','pesticides'));
    }

    public function consult()

    {

        $pesticide_applys = Pesticide_apply::all();

        $grounds = Ground::where('in_use', '=', "S")->get();

        $accounts = auth()->user()->account()->get();

        $accountings = Accounting::where('in_use', '=', "S")->get();

        $workers = Worker::where('in_use', '=', "S")->orderby('name','asc')->get();

        $pesticides = Pesticide::where('in_use', '=', "S")->orderby('name','asc')->get();

       // dd($pesticide_applys,$pesticides);

    return view('Pesticide/Pesticide_apply.Pesticide_apply_research.research', compact('pesticide_applys','accounts','accountings','grounds','workers','pesticides'));

    }
    
    public function research(Request $request)
    {

       $pesquisa = $request;


        $termos = $request->only('pesticide_id', 'worker_id', 'ground_id','accounting_id', 'date_inicial', 'date_final' );
        $prepareQuery = "";
        $query = "";
        foreach ($termos as $nome => $valor) {

            if($valor){
              // $query = $query . "where("."'".$nome."'".","."'"."="."'".","."'". $valor. "')->";
                if ($nome == "pesticide_id" or $nome == "worker_id" or  $nome == "ground_id" or $nome == "accounting_id")
                    $prepareQuery = $prepareQuery . $nome. '="'. $valor. '" AND ';
                if ($nome == "date_inicial") 
                        $prepareQuery = $prepareQuery . 'date'. '>="'. $valor. '" AND ';
                if ($nome == "date_final")
                        $prepareQuery = $prepareQuery . 'date'. '<="'. $valor. '" AND ';
            
            }
         }

         $query = substr($prepareQuery, 0 , -5);


         if ($query)
            $pesticide_applys = Pesticide_apply::whereRaw($query)->orderBy('date')->get();
         else
            $pesticide_applys = Pesticide_apply::orderBy('date')->get();

        $grounds = Ground::where('in_use', '=', "S")->get();
    
        $accounts = auth()->user()->account()->get();
    
        $accountings = Accounting::where('in_use', '=', "S")->get();
    
        $workers = Worker::where('in_use', '=', "S")->get();
    
        $pesticides = Pesticide::where('in_use', '=', "S")->get();;

 
    return view('Pesticide/Pesticide_apply.Pesticide_apply_research.index', compact('pesticide_applys', 'pesticides','grounds','workers','accountings'));
    }
}
