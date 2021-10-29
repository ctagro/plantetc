<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type_product;
use App\Models\Provide;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\User;
use Cookie;
use App\Models\Fertilizer_entry;
use App\Models\Fertilizer_inventory;
use Carbon\Carbon;
use Redirect;

class fertilizer_entryController extends Controller
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
   
   $fertilizer_entrys = fertilizer_entry::all();

   $products = Product::all();

   $provides = Provide::all();

   //dd($provides);

    $type_products= Type_product::all();



  // dd($fertilizer_entrys,$type_products);



    $response = $fertilizer_entrys->first(); 
    $last = $fertilizer_entrys->last();

if($last!=null){ 
    
        $nr = $last['id'];

    

        if($nr>5):
            $nr = $nr-5;
            $fertilizer_entrys = fertilizer_entry::where('id','>', $nr)->get();
        else:  
            $fertilizer_entrys = fertilizer_entry::all();
    
        endif;
    
    }

    if ($response === null) {

        
        $fertilizer_entry = new fertilizer_entry();
    

   

        return view('inventory.fertilizer_entry.index',compact('fertilizer_entrys','type_products','fertilizer_entry','provides','products'));
    } 
   // dd($fertilizer_entrys,$provides);
        return view('inventory.fertilizer_entry.index',compact('fertilizer_entrys','type_products','provides','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = auth()->user();

        $fertilizer_entrys = auth()->user()->fertilizer_entry()->get();

        $type_products= Type_product::all();

        $products = Product::all();

        $provides = Provide::all();
  
        $fertilizer_entry = new \App\Models\fertilizer_entry([

        ]);

        return view('inventory.fertilizer_entry.create',compact('fertilizer_entrys','type_products','provides','products'));
       
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

   
     $productInventory = Product::where('id', '=' , $data['product_id'])->get()->toArray();

     $productInventory = $productInventory;

     $dataProduct = Arr::pull($productInventory, 0);

     

     $dataProduct['price'] = $data['price_unit'];
     $dataProduct['price_unit'] = $data['price_unit_cons'];

//  dd($dataProduct,$data);



    ////===================Inicio atualizacao do estoque =======================

    //    Montando o array do Estoque de fertilisante
 
    $fertilizer_inventory = Fertilizer_inventory::where('product_id', '=' , $data['product_id'])->get()->toArray();

//dd($fertilizer_inventory);

      if ($fertilizer_inventory ==[]){
          return redirect()
          ->back()
          ->with('sucess', 'O Produto ## '. $dataProduct['name'] .  ' ## não consta do Estoque. Cadastrar para continuar!!');
       }

      $fertilizerInventory = $fertilizer_inventory;

      $dataInventory = Arr::pull($fertilizerInventory, 0);

    //  dd($data);

     // dd($dataInventory['entry'],$dataInventory['exit'],$dataInventory['balance']);

      $dataInventory['date'] =  $dataAccount['date'];
      $dataInventory['entry'] = $dataInventory['entry'] + $data['quantity_cons'];      
      $dataInventory['balance'] =  $dataInventory['entry'] - $dataInventory['exit'];
  //  dd($dataInventory['entry'],$dataInventory['exit'],$dataInventory['balance']);

  // dd(is_array($dataInventory));

      $updateFertilizer_inventory =  DB::table('fertilizer_inventories')->where('product_id', '=' , $data['product_id'])->update($dataInventory);

      if (!$updateFertilizer_inventory){

      return redirect()
                  ->back()
                  ->with('error',  'Falha na atualização da estoque');     

    }

///========================Fim atualizacao do estoque========================///



///========================Atualizado preço e preço unitário do produto =======///

$updateProduct =  DB::table('products')->where('id', '=' , $data['product_id'])->update($dataProduct);

if (!$updateProduct){

return redirect()
            ->back()
            ->with('error',  'Falha na atualização do produto');     

}
     
        
        $fertilizer_entry = new fertilizer_entry();

        $response = $fertilizer_entry->storeFertilizer_entry($data);


        if ($response['sucess'])

            return redirect()
                        ->route('fertilizer_entry.index')
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
    public function show(fertilizer_entry $fertilizer_entry)
    {

        $type_products= type_product::all();

        $products = Product::all();

        $provides = Provide::all();

        return view('inventory.fertilizer_entry.show', compact('fertilizer_entry','type_products','provides','products' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(fertilizer_entry $fertilizer_entry) {


        $user = auth()->user();

        $type_products= type_product::all();

        $products = Product::all();

        $provides = Provide::all();


        return view('inventory.fertilizer_entry.edit',compact('fertilizer_entry','type_products','provides','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, fertilizer_entry $fertilizer_entry)
    {  

        if ($request['date'] == null){
            $dataP = explode('/',$fertilizer_entry->date);
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
        $data['product_id']           = $dataRequest['product_id'];
        $data['provide_id']           = $dataRequest['provide_id'];
        $data['quantity']             = $dataRequest['quantity'];
        $data['price_unit']           = $dataRequest['price_unit'];
        $data['amount']               = $dataRequest['amount'];
        $data['quantity_cons']        = $dataRequest['quantity_cons'];
        $data['price_unit_cons']      = $dataRequest['price_unit_cons'];
        $data['note']                 = $dataRequest['note'];
    

     //  dd($data);

        $fertilizer_entry -> update($data);

        if ($fertilizer_entry)

        return redirect()
                        ->route('fertilizer_entry.edit' ,[ 'fertilizer_entry' => $fertilizer_entry->id ])
                        ->with('sucess', 'Atualização realizada, confirme a necessidade de ajustar o estoque e produto!!!');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha na atualização da atividade');    



        return redirect('/fertilizer_entry');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(fertilizer_entry $fertilizer_entry)
    {

        //dd($fertilizer_entry);       
        $fertilizer_entry->delete();

        return redirect()
        ->route('fertilizer_entry.index')
        ->with('sucess', 'Deleção realizada, confirme a necessidade de ajustar o estoque!!!');

    }

    private function validateRequest()
    {

        return request()->validate([
            
            'date'                  => 'required' ,
            'type_product_id'       => 'required' ,
            'product_id'            => 'required' ,
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
