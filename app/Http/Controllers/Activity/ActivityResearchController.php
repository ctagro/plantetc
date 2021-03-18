<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
use App\Models\Activity;
use App\Models\Worker;
use App\Models\Ground;
use App\Models\Product;

class ActivityResearchController extends Controller
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
   
    $activitys = auth()->user()->activity()->get();

    $type_activitys = auth()->user()->type_activity()->get();

    $grounds = auth()->user()->ground()->get();

    $workers = auth()->user()->worker()->get();

    $products = auth()->user()->product()->get();

        return view('activity.activity_research.index',compact('activitys','type_activitys','grounds','workers','products'));
    }

    public function consult()

    {

        $activitys = auth()->user()->activity()->get();

        $type_activitys = auth()->user()->type_activity()->get();

        $grounds = auth()->user()->ground()->get();

        $workers = auth()->user()->worker()->get();

        $products = auth()->user()->product()->get();

    return view('activity.activity_research.research', compact('activitys','type_activitys','grounds','workers','products'));

    }
    
    public function research(Request $request)
    {

       $pesquisa = $request;


        $termos = $request->only('description', 'type_activity_id', 'worker_id', 'ground_id','product_id', 'date_inicial', 'date_final' );
        $prepareQuery = "";
        $query = "";
        foreach ($termos as $nome => $valor) {

            if($valor){
              //  $query = $query . "where("."'".$nome."'".","."'"."="."'".","."'". $valor. "')->";
                if ($nome == "description")
                    $prepareQuery = $prepareQuery . $nome. ' LIKE "'. '%'.$valor.'%'. '" AND ';   
                if ($nome == "type_activity_id" or $nome == "worker_id" or  $nome == "ground_id" or $nome == "product_id")
                    $prepareQuery = $prepareQuery . $nome. '="'. $valor. '" AND ';
                if ($nome == "date_inicial") 
                        $prepareQuery = $prepareQuery . 'date'. '>="'. $valor. '" AND ';
                if ($nome == "date_final")
                        $prepareQuery = $prepareQuery . 'date'. '<="'. $valor. '" AND ';
            
            }
         }

   
         $query = substr($prepareQuery, 0 , -5);


         if ($query)
            $activitys = activity::whereRaw($query)->orderBy('date')->get();
         else
            $activitys = activity::orderBy('date')->get();

         $type_activitys = auth()->user()->type_activity()->get();
          
         $grounds = auth()->user()->ground()->get();

         $workers = auth()->user()->worker()->get();
 
         $products = auth()->user()->product()->get();

 
    return view('activity.activity_research.index', compact('activitys', 'type_activitys','grounds','workers','products'));
    }
}
