<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Models\Fertilizer_inventory;
use App\Models\Provide;
use App\Models\Product;
use App\Models\Status_inventory;
use App\Models\Type_product;

class Fertilizer_inventoryController extends Controller
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
    
        $statuss = Status_inventory::all();
   
    $fertilizer_inventorys = Fertilizer_inventory::all();


        return view('inventory.fertilizer_inventory.index',compact('fertilizer_inventorys','statuss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       

        $user = auth()->user();

        $fertilizer_inventorys = Fertilizer_inventory::all();

        $products = Product::all();

        $provides = Provide::all();

        $type_products = Type_product::all();

        $fertilizer_inventorys = Fertilizer_inventory::all();

        $statuss = Status_inventory::all();

       // dd($statuss);


        $fertilizer_inventory = new \App\Models\Fertilizer_inventory([

        ]);

   
        return view('inventory.fertilizer_inventory.create',compact('fertilizer_inventory','fertilizer_inventorys','products','provides','type_products','statuss'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      

        if ($request['note'] == null){
            $request['note'] = "...";
         }

            $request['type_product_id'] = 1;

        $data = $request; 

        $fertilizer_inventory = DB::table('fertilizer_inventories')->where('product_id', '=' , $data['product_id'])->get();
    
    // dd((!$fertilizer_inventory->isEmpty()),$fertilizer_inventory,$data['product_id']);


        if (!$fertilizer_inventory->isEmpty()){

            $product = Product::find($data['product_id']);

            return redirect()
                        ->back()
                        ->with('error',  'O Produto ## '. $product->name .  ' ## já consta do Estoque.');     
      
          }
 
 
        
         $data = $this->validateRequest();


     
       
 
      $dataFertilizer_inventory['date' ]           = $data['date'];
      $dataFertilizer_inventory['type_product_id'] = $data['type_product_id'];
      $dataFertilizer_inventory['provide_id']      = $data['provide_id'];
      $dataFertilizer_inventory['product_id']      = $data['product_id'];
      $dataFertilizer_inventory['entry']           = $data['entry'];
      $dataFertilizer_inventory['exit']            = $data['exit'];
      $dataFertilizer_inventory['balance']         = ($data['entry']- $data['exit']);
      $dataFertilizer_inventory['minimum_stock']   = $data['minimum_stock'];
      $dataFertilizer_inventory['status']          = $data['status'];
      $dataFertilizer_inventory['note']            = $data['note'];

      
        $fertilizer_inventory = new fertilizer_inventory();
    
        $response = $fertilizer_inventory->storeFertilizer_inventory($data);

      
        
        if ($response)

        return redirect()
                        ->route('fertilizer_inventory.create')
                        ->with('sucess', 'Cadastro realizado com sucesso');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha ao cadastrar da estoque');


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Fertilizer_inventory $fertilizer_inventory)
    {

        return view('inventory.fertilizer_inventory.show', compact('fertilizer_inventory' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Fertilizer_inventory $fertilizer_inventory) {


        $user = auth()->user();

        $fertilizer_inventorys = Fertilizer_inventory::all();

        $products = Product::all();

        $provides = Provide::all();

        $type_products = Type_product::all();

        $statuss = Status_inventory::all();

        


        return view('inventory.fertilizer_inventory.edit',compact('fertilizer_inventory','products','provides','type_products', 'statuss'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fertilizer_inventory $fertilizer_inventory)
    {

           
     // enquanto nao impre,memtar o tipo de produto fertilozante 
     // será 1  

         $request['type_product_id'] = 1;
        

        if ($request['date'] == null){
            $dataP = explode('/',$fertilizer_inventory->date);
            $request['date'] = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];
         }

         if ($request['note'] == null){
            $request['note'] = "...";
         }


        $dataRequest = $this->validateRequest();

       
        $dataFertilizer_inventory['date']                       = $dataRequest['date'];
        $dataFertilizer_inventory['type_product_id']            = $dataRequest['type_product_id'];
        $dataFertilizer_inventory['product_id']                 = $dataRequest['product_id'];
        $dataFertilizer_inventory['provide_id']                 = $dataRequest['provide_id'];
        $dataFertilizer_inventory['entry']                      = $dataRequest['entry'];
        $dataFertilizer_inventory['exit']                       = $dataRequest['exit'];
        $dataFertilizer_inventory['balance']                    = $dataRequest['entry']-$dataRequest['exit'];
        $dataFertilizer_inventory['minimum_stock']              = $dataRequest['minimum_stock'];
        $dataFertilizer_inventory['status']                     = $dataRequest['status'];
        $dataFertilizer_inventory['note']                       = $dataRequest['note'];
  
      //  dd($dataFertilizer_inventory);
        
       $updateFertilizer_inventory = $fertilizer_inventory -> update($dataFertilizer_inventory);


       if ($updateFertilizer_inventory)

        return redirect()
                        ->route('fertilizer_inventory.edit' ,[ 'fertilizer_inventory' => $fertilizer_inventory->id ])
                        ->with('sucess', 'Sucesso ao atualizar');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha na atualização da atividade');     

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fertilizer_inventory $fertilizer_inventory)
    {
        $fertilizer_inventory->delete();

        return redirect('fertilizer_inventory');
    }

    private function validateRequest()
    {

        return request()->validate([
             
            
            'date'                  =>   'required',
            'type_product_id'       =>   'required',
            'product_id'            =>   'required',
            'provide_id'            =>   'required',
            'entry'                 =>   'required',
            'exit'                  =>   'required',
            'balance'               =>   'required',
            'minimum_stock'         =>   'required',
            'status'                =>   'required',
            'note'                  =>   'required',


    
       ]);


    }
}
