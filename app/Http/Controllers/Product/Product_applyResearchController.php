<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
use App\Models\Product_apply;
use App\Models\Worker;
use App\Models\Account;
use App\Models\Accounting;
use App\Models\Ground;
use App\Models\Product;

class Product_applyResearchController extends Controller
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
   
    $product_applys = product_apply()->all();

    $grounds = Ground::where('in_use', '=', "S")->get();

    $bayers = Bayer::where('in_use', '=', "S")->orderby('name','asc')->get();

    $accounts = auth()->user()->account()->get();

    $accountings = Accounting::where('in_use', '=', "S")->get();

    $workers = Worker::where('in_use', '=', "S")->orderby('name','asc')->get();

    $products = Product::where('in_use', '=', "S")->orderby('name','asc')->get();

        return view('product/product_apply.product_apply_research.index',compact('product_applys','accounts','accountings','grounds','workers','products'));
    }

    public function consult()

    {

        $product_applys = auth()->user()->product_apply()->get();

        $grounds = Ground::where('in_use', '=', "S")->get();

        $accounts = auth()->user()->account()->get();

        $accountings = Accounting::where('in_use', '=', "S")->get();

        $workers = Worker::where('in_use', '=', "S")->orderby('name','asc')->get();

        $products = Product::where('in_use', '=', "S")->orderby('name','asc')->get();

    return view('product/product_apply.product_apply_research.research', compact('product_applys','accounts','accountings','grounds','workers','products'));

    }
    
    public function research(Request $request)
    {

       $pesquisa = $request;

      


        $termos = $request->only('product_id', 'worker_id', 'ground_id','accounting_id', 'date_inicial', 'date_final' );
        $prepareQuery = "";
        $query = "";
        foreach ($termos as $nome => $valor) {

            if($valor){
              //  $query = $query . "where("."'".$nome."'".","."'"."="."'".","."'". $valor. "')->";
                if ($nome == "product_id" or $nome == "worker_id" or  $nome == "ground_id" or $nome == "accounting_id")
                    $prepareQuery = $prepareQuery . $nome. '="'. $valor. '" AND ';
                if ($nome == "date_inicial") 
                        $prepareQuery = $prepareQuery . 'date'. '>="'. $valor. '" AND ';
                if ($nome == "date_final")
                        $prepareQuery = $prepareQuery . 'date'. '<="'. $valor. '" AND ';
            
            }
         }

         $query = substr($prepareQuery, 0 , -5);


         if ($query)
            $product_applys = product_apply::whereRaw($query)->orderBy('date')->get();
         else
            $product_applys = product_apply::orderBy('date')->get();

        $grounds = Ground::where('in_use', '=', "S")->get();
    
        $accounts = auth()->user()->account()->get();
    
        $accountings = Accounting::where('in_use', '=', "S")->get();
    
        $workers = Worker::where('in_use', '=', "S")->get();
    
        $products = Product::where('in_use', '=', "S")->get();;

 
    return view('product/product_apply.product_apply_research.index', compact('product_applys', 'products','grounds','workers','accountings'));
    }
}
