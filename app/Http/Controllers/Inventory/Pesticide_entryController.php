<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type_product;
use App\Models\Provide;
use App\Models\Pesticide;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\User;
use Cookie;
use App\Models\Pesticide_entry;
use App\Models\Pesticide_inventory;
use Carbon\Carbon;
use Redirect;

class Pesticide_entryController extends Controller
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
   
   $pesticide_entrys = pesticide_entry::all();

   $pesticides = Pesticide::all();

   $provides = Provide::all();

   //dd($provides);

    $type_products= Type_product::all();



  // dd($pesticide_entrys,$type_products);



    $response = $pesticide_entrys->first(); 
    $last = $pesticide_entrys->last();

    if($last!=null){   
    
        $nr = $last['id'];

       //dd($nr);

      // dd($pesticide_entrys);


    

 //       if($nr>5):
 //           $nr = $nr-5;
 //           $pesticide_entrys = pesticide_entry::where('id','>', $nr)->get();
 //       else:  
 //           $pesticide_entrys = pesticide_entry::all();
    
 //       endif;
    }

    if ($response === null) {

        
        $pesticide_entry = new pesticide_entry();
    

   

        return view('inventory.pesticide_entry.index',compact('pesticide_entrys','type_products','pesticide_entry','provides','pesticides'));
    } 
   // dd($pesticide_entrys,$provides);
        return view('inventory.pesticide_entry.index',compact('pesticide_entrys','type_products','provides','pesticides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = auth()->user();

        $pesticide_entrys = Pesticide_entry::pesticide_entry()->get();

        $type_products= Type_product::all();

        $pesticides = Pesticide::all();

        $provides = Provide::all();
  
        $pesticide_entry = new \App\Models\pesticide_entry([

        ]);

        return view('inventory.pesticide_entry.create',compact('pesticide_entrys','type_products','provides','pesticides'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     **/
    public function store(Request $request)
    {


        if ($request['note'] == null){
            $request['note'] = "...";
         }

         $data = $this->validateRequest();

         $dataAccount['date' ] = $request['date'];
         $date['note'] = $request['note'];
         
         $dataAccount['date'] = $request['date'];

   
     $pesticide = Pesticide::where('id', '=' , $data['pesticide_id'])->first();

     $dataPesticide = $pesticide->toArray();

    //======== atualizacao dos campos da tabela pesticides

     $dataPesticide['price'] = $data['price_unit'];
     $dataPesticide['price_unit'] = $data['price_unit_cons'];

     //======== atualizacao dos campos da tabela pesticide_entries

        $dataEntry['date']                 = $data['date'];
        $dataEntry['type_product_id']      = $data['type_product_id'];
        $dataEntry['pesticide_id']         = $data['pesticide_id'];
        $dataEntry['provide_id']           = $data['provide_id'];
        $dataEntry['quantity']             = $data['quantity'];
        $dataEntry['price_unit']           = $data['price_unit'];
        $dataEntry['amount']               = $data['amount'];
        $dataEntry['quantity_cons']        = $data['quantity_cons'];
        $dataEntry['price_unit_cons']      = $data['price_unit_cons'];
        $dataEntry['note']                 = $data['note'];

  //      dd($dataPesticide['price_unit'],$data['price_unit_cons']);
 // dd($dataPesticide['id'],$data);

 // $data = entrada formulario
 // $dataEntry = (pesticide_entry)
 // $dataPesticide  =defensivo (pesticide)
 // $pesticide_inventory = Estoque (pesticide_inventory) - $dataInventory



    ////===================Inicio atualizacao do estoque =======================

    //   Captura o registro do estoque relacionado
 
    $pesticide_inventory = Pesticide_inventory::where('pesticide_id', '=' , $data['pesticide_id'])->first();

   // dd($dataPesticide,$pesticide_inventory,$data);

 // testa se o pesticida já esta cadastrado no estoque
 // se nao: informa que o pesticida deve ser cadastrado no estoque

    if (is_null($pesticide_inventory)){
          return redirect()
          ->back()
          ->with('sucess', 'O Defensivo ## '. $dataPesticide['name'] .  ' ## não consta do Estoque. Cadastrar para continuar!!');
       }

    // cria array espelho do registro para alteracao dos devidos campos

       $dataInventory = $pesticide_inventory->toArray();

  // calcula e altera os devidos campos do estoque

      $dataInventory['date'] =  $dataAccount['date'];
      $dataInventory['entry'] = $pesticide_inventory->entry + $data['quantity_cons'];      
      $dataInventory['balance'] =  $dataInventory['entry'] - $dataInventory['exit'];
  //  dd($dataInventory['entry'],$dataInventory['exit'],$dataInventory['balance']);
//dd($pesticide_inventory->entry,$dataInventory['entry']);
  

  //=========== Atualizar status do estoque==============


    //==== 1 - Estoque confortável -> Est Min > 110% estoque 
    //==== 2 - Estoque no limite -> Est Min < 110% estoque > 100%
    //==== 3 - Estoque confortável -> Est Min < 100% estoque 

    if ($dataInventory['balance'] > (1.10 * $dataInventory['minimum_stock'])){
        $dataInventory['status'] = 1;
        }elseif (($dataInventory['balance'] <= (1.10 * $dataInventory['minimum_stock']) && 
                ($dataInventory['balance'] > ($dataInventory['minimum_stock'])))){
        $dataInventory['status'] = 2;
                }elseif ($dataInventory['balance'] <= ($dataInventory['minimum_stock'])) {
                $dataInventory['status'] = 3;
    }
 
  // dd($pesticide_inventory->id,$dataInventory['id']);
  // Atualiza o estoque  ----

  $updatePesticide_inventory =  DB::table('pesticide_inventories')->where('id', '=' , $dataInventory['id'])->update($dataInventory);

//dd($updatePesticide_inventory);



      if (!$updatePesticide_inventory){
   
      return redirect()
                  ->back()
                  ->with('error',  'Falha na atualização da estoque');     

    }

///========================Fim atualizacao do estoque========================///


///========================Atualizado preço e preço unitário do produto =======///




$updatePesticide =  DB::table('pesticides')->where('id', '=' , $dataPesticide['id'])->update($dataPesticide);

if (!$updatePesticide){

return redirect()
            ->back()
            ->with('error',  'Falha na atualização do produto');     

}

//===========================Registrar a entrada no estoque==================
        
        $pesticide_entry = new pesticide_entry();

        $response = $pesticide_entry->storePesticide_entry($dataEntry);

        if ($response['sucess'])

            return redirect()
                        ->route('pesticide_entry.index')
                        ->with('sucess', $response['mensage']);
                    

        return redirect()
                    ->back()
                    ->with('error', $response['mensage']);

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(pesticide_entry $pesticide_entry)
    {

        $type_products= type_product::all();

        $pesticides = Pesticide::all();

        $provides = Provide::all();

        return view('inventory.pesticide_entry.show', compact('pesticide_entry','type_products','provides','pesticides' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(pesticide_entry $pesticide_entry) {


        $user = auth()->user();

        $type_products= type_product::all();

        $pesticides = Pesticide::all();

        $provides = Provide::all();

        return view('inventory.pesticide_entry.edit',compact('pesticide_entry','type_products','provides','pesticides'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pesticide_entry $pesticide_entry)
    {  

        if ($request['date'] == null){
            $dataP = explode('/',$pesticide_entry->date);
            $request['date'] = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];
        }

        if ($request['note'] == null){
            $request['note'] = "...";
         }

         if ($request['price_unit_cons'] == null){
            $request['price_unit_cons'] = 0;
         }

      

                       
        $dataRequest = $this->validateRequest();

    

        $data['date']                 = $dataRequest['date'];
        $data['type_product_id']      = $dataRequest['type_product_id'];
        $data['pesticide_id']         = $dataRequest['pesticide_id'];
        $data['provide_id']           = $dataRequest['provide_id'];
        $data['quantity']             = $dataRequest['quantity'];
        $data['price_unit']           = $dataRequest['price_unit'];
        $data['amount']               = $dataRequest['amount'];
        $data['quantity_cons']        = $dataRequest['quantity_cons'];
        $data['price_unit_cons']      = $dataRequest['price_unit_cons'];
        $data['note']                 = $dataRequest['note'];
    

     //  dd($data);

        $pesticide_entry -> update($data);

        if ($pesticide_entry)

        return redirect()
                        ->route('pesticide_entry.edit' ,[ 'pesticide_entry' => $pesticide_entry->id ])
                        ->with('sucess', 'Atualização realizada, confirme a necessidade de ajustar o estoque e produto!!!');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha na atualização da atividade');    



        return redirect('/pesticide_entry');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(pesticide_entry $pesticide_entry)
    {

        //dd($pesticide_entry);       
        $pesticide_entry->delete();

        return redirect()
        ->route('pesticide_entry.index')
        ->with('sucess', 'Deleção realizada, confirme a necessidade de ajustar o estoque!!!');

    }

    private function validateRequest()
    {

        return request()->validate([
            
            'date'                  => 'required' ,
            'type_product_id'       => 'required' ,
            'pesticide_id'          => 'required' ,
            'provide_id'            => 'required' ,
            'quantity'              => 'required' ,
            'price_unit'            => 'required' ,           
            'amount'                => 'required' ,
            'quantity_cons'         => 'required' ,
            'price_unit_cons'       => 'required' ,
            'note'                  => 'required' ,
    
       ]);


    }
}
