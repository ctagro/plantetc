<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Models\Pesticide_inventory;
use App\Models\Pesticide;
use App\Models\Status_inventory;
use App\Models\Type_product;
use App\Models\Provide;

class Pesticide_inventoryController extends Controller
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
   
    $pesticide_inventorys = Pesticide_inventory::all();


        return view('inventory.pesticide_inventory.index',compact('pesticide_inventorys','statuss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       

        $user = auth()->user();

        $pesticide_inventorys = Pesticide_inventory::all();

        $pesticides = Pesticide::all();

        $provides = Provide::all();

        $type_products = Type_product::all();

        $pesticide_inventorys = Pesticide_inventory::all();

        $statuss = Status_inventory::all();

       // dd($statuss);


        $pesticide_inventory = new \App\Models\Pesticide_inventory([

        ]);

   
        return view('inventory.pesticide_inventory.create',compact('pesticide_inventory','pesticide_inventorys','pesticides','provides','type_products','statuss'));
       
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

            $request['type_product_id'] = 2;

        $data = $request; 



        $pesticide_inventory = DB::table('pesticide_inventories')->where('pesticide_id', '=' , $data['pesticide_id'])->get();
    
    
    //   dd((!$pesticide_inventory->isEmpty()),$pesticide_inventory,$data['pesticide_id']);

   //     dd($pesticide_inventory['deleted_at']);

        if (!$pesticide_inventory->isEmpty()){

            $pesticide = Pesticide::find($data['pesticide_id']);

            return redirect()
                        ->back()
                        ->with('error',  'O Defensivo ## '. $pesticide->name .  ' ## já consta do Estoque.');     
      
          }
 
 
        
         $data = $this->validateRequest();


     
       
 
      $dataPesticide_inventory['date' ]           = $data['date'];
      $dataPesticide_inventory['type_product_id'] = $data['type_product_id'];
      $dataPesticide_inventory['provide_id']      = $data['provide_id'];
      $dataPesticide_inventory['pesticide_id']    = $data['pesticide_id'];
      $dataPesticide_inventory['entry']           = $data['entry'];
      $dataPesticide_inventory['exit']            = $data['exit'];
      $dataPesticide_inventory['balance']         = ($data['entry']- $data['exit']);
      $dataPesticide_inventory['minimum_stock']   = $data['minimum_stock'];
      $dataPesticide_inventory['status']          = $data['status'];
      $dataPesticide_inventory['note']            = $data['note'];

      
        $pesticide_inventory = new pesticide_inventory();
    
        $response = $pesticide_inventory->storePesticide_inventory($data);

      
        
        if ($response)

        return redirect()
                        ->route('pesticide_inventory.create')
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
    public function show(Pesticide_inventory $pesticide_inventory)
    {

        return view('inventory.pesticide_inventory.show', compact('pesticide_inventory' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesticide_inventory $pesticide_inventory) {


        $user = auth()->user();

        $pesticide_inventorys = Pesticide_inventory::all();

        $pesticides = Pesticide::all();

        $provides = Provide::all();

        $type_products = Type_product::all();

        $statuss = Status_inventory::all();

        


        return view('inventory.pesticide_inventory.edit',compact('pesticide_inventory','pesticides','provides','type_products', 'statuss'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pesticide_inventory $pesticide_inventory)
    {

           
     // enquanto nao impre,memtar o tipo de produto fertilozante 
     // será 1  

         $request['type_product_id'] = 2;
        

        if ($request['date'] == null){
            $dataP = explode('/',$pesticide_inventory->date);
            $request['date'] = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];
         }

         if ($request['note'] == null){
            $request['note'] = "...";
         }


        $dataRequest = $this->validateRequest();

       
        $dataPesticide_inventory['date']                       = $dataRequest['date'];
        $dataPesticide_inventory['type_product_id']            = $dataRequest['type_product_id'];
        $dataPesticide_inventory['pesticide_id']                 = $dataRequest['pesticide_id'];
        $dataPesticide_inventory['provide_id']                 = $dataRequest['provide_id'];
        $dataPesticide_inventory['entry']                      = $dataRequest['entry'];
        $dataPesticide_inventory['exit']                       = $dataRequest['exit'];
        $dataPesticide_inventory['balance']                    = $dataRequest['entry']-$dataRequest['exit'];
        $dataPesticide_inventory['minimum_stock']              = $dataRequest['minimum_stock'];
        $dataPesticide_inventory['status']                     = $dataRequest['status'];
        $dataPesticide_inventory['note']                       = $dataRequest['note'];
  
      //  dd($dataPesticide_inventory);
        
       $updatePesticide_inventory = $pesticide_inventory -> update($dataPesticide_inventory);


       if ($updatePesticide_inventory)

        return redirect()
                        ->route('pesticide_inventory.edit' ,[ 'pesticide_inventory' => $pesticide_inventory->id ])
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
    public function destroy(Pesticide_inventory $pesticide_inventory)
    {
        $pesticide_inventory->delete();

        return redirect('pesticide_inventory');
    }

    private function validateRequest()
    {

        return request()->validate([
             
            
            'date'                  =>   'required',
            'type_product_id'       =>   'required',
            'pesticide_id'          =>   'required',
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
