<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
use App\Models\Pesticide_apply;
use App\Models\Ground;
use App\Models\Pesticide;
use App\Models\Pesticide_entry;
use App\Models\Pesticide_inventory;

class Pesticide_inventoryResearchController extends Controller
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

    $pesticides = Pesticide::where('in_use', '=', "S")->orderby('name','asc')->get();

        return view('inventory.pesticide_inventary_research.index',compact('pesticide_applys','grounds','pesticides'));
    }

    public function consult()

    {

        $pesticide_applys = Pesticide_apply::all();

        $grounds = Ground::where('in_use', '=', "S")->get();

        $pesticides = Pesticide::where('in_use', '=', "S")->orderby('name','asc')->get();

    return view('inventory.pesticide_inventory_research.research', compact('pesticide_applys','grounds','pesticides'));

    }
    
    public function research(Request $request)
    {

        $grounds = Ground::where('in_use', '=', "S")->get();
    
        $pesticides = Pesticide::where('in_use', '=', "S")->get();

       $pesquisa = $request;

        $termos = $request->only('pesticide_id', 'date_inicial', 'date_final' );
        $prepareQuery = "";
        $query = "";
        foreach ($termos as $nome => $valor) {

            if($valor){
              //  $query = $query . "where("."'".$nome."'".","."'"."="."'".","."'". $valor. "')->";
                if ($nome == "pesticide_id")
                    $prepareQuery = $prepareQuery . $nome. '="'. $valor. '" AND ';
                if ($nome == "date_inicial") 
                        $prepareQuery = $prepareQuery . 'date'. '>="'. $valor. '" AND ';
                if ($nome == "date_final")
                        $prepareQuery = $prepareQuery . 'date'. '<="'. $valor. '" AND ';
            
            }
         }

        $query = substr($prepareQuery, 0 , -5);

        $pesticide_entrys = $this->pesticide_entry($query);

        $pesticide_applys = $this->apply($query);

        $pesticide_inventorys = $this->pesticide_inventory($query);

         return view('inventory.pesticide_inventory_research.index', compact('pesticide_entrys','pesticide_applys', 'pesticide_inventorys', 'pesticides','grounds'));

    }

    public function pesticide_entry($query)
    {

         if ($query)
            $pesticide_entry = pesticide_entry::whereRaw($query)->orderBy('date')->get();
         else
            $pesticide_entry = pesticide_entry::orderBy('date')->get();

    return  $pesticide_entry;
    }
    
    
    public function apply($query)
    {
    
         if ($query)
            $pesticide_applys = pesticide_apply::whereRaw($query)->orderBy('date')->get();
         else
            $pesticide_applys = pesticide_apply::orderBy('date')->get();

    return  $pesticide_applys;
    }

    

    public function pesticide_inventory($query)
    {

         if ($query)
            $pesticide_inventory = pesticide_inventory::whereRaw($query)->orderBy('date')->get();
         else
            $pesticide_inventory = pesticide_inventory::orderBy('date')->get();

    //dd($pesticide_inventory);

    return  $pesticide_inventory;
    }

}
