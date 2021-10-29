<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
use App\Models\Product_apply;
use App\Models\Ground;
use App\Models\Product;
use App\Models\Fertilizer_entry;
use App\Models\Fertilizer_inventory;

class Fertilizer_inventoryResearchController extends Controller
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
   
    $product_applys = Product_apply::all();

    $grounds = Ground::where('in_use', '=', "S")->get();

    $products = Product::where('in_use', '=', "S")->orderby('name','asc')->get();

        return view('inventory.fertilizer_inventary_research.index',compact('product_applys','grounds','products'));
    }

    public function consult()

    {

        $product_applys = Product_apply::all();

        $grounds = Ground::where('in_use', '=', "S")->get();

        $products = Product::where('in_use', '=', "S")->orderby('name','asc')->get();

    return view('inventory.fertilizer_inventory_research.research', compact('product_applys','grounds','products'));

    }
    
    public function research(Request $request)
    {

        $grounds = Ground::where('in_use', '=', "S")->get();
    
        $products = Product::where('in_use', '=', "S")->get();

       $pesquisa = $request;

        $termos = $request->only('product_id', 'date_inicial', 'date_final' );
        $prepareQuery = "";
        $query = "";
        foreach ($termos as $nome => $valor) {

            if($valor){
              //  $query = $query . "where("."'".$nome."'".","."'"."="."'".","."'". $valor. "')->";
                if ($nome == "product_id")
                    $prepareQuery = $prepareQuery . $nome. '="'. $valor. '" AND ';
                if ($nome == "date_inicial") 
                        $prepareQuery = $prepareQuery . 'date'. '>="'. $valor. '" AND ';
                if ($nome == "date_final")
                        $prepareQuery = $prepareQuery . 'date'. '<="'. $valor. '" AND ';
            
            }
         }

        $query = substr($prepareQuery, 0 , -5);

        $fertilizer_entrys = $this->fertilizer_entry($query);

        $product_applys = $this->apply($query);

        $fertilizer_inventorys = $this->fertilizer_inventory($query);

         return view('inventory.fertilizer_inventory_research.index', compact('fertilizer_entrys','product_applys', 'fertilizer_inventorys', 'products','grounds'));

    }

    public function fertilizer_entry($query)
    {

         if ($query)
            $fertilizer_entry = fertilizer_entry::whereRaw($query)->orderBy('date')->get();
         else
            $fertilizer_entry = fertilizer_entry::orderBy('date')->get();

    return  $fertilizer_entry;
    }
    
    
    public function apply($query)
    {
    
         if ($query)
            $product_applys = product_apply::whereRaw($query)->orderBy('date')->get();
         else
            $product_applys = product_apply::orderBy('date')->get();

    return  $product_applys;
    }

    

    public function fertilizer_inventory($query)
    {

         if ($query)
            $fertilizer_inventory = fertilizer_inventory::whereRaw($query)->orderBy('date')->get();
         else
            $fertilizer_inventory = fertilizer_inventory::orderBy('date')->get();

    //dd($fertilizer_inventory);

    return  $fertilizer_inventory;
    }

}
