<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\User;
use App\Models\Product;
Use App\Models\Worker;
use App\Models\Ground;
use App\Models\Product_apply;
use App\Models\Account;
use App\Models\Accounting;
use App\Models\Fertilizer_inventory;

class Product_applyController extends Controller
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

   //dd($product_applys);

        return view('product.product_apply.index',compact('product_applys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       

        $user = auth()->user();

        $accounts = auth()->user()->account()->get();

        $product_applys = auth()->user()->product_apply()->get();

        $grounds = Ground::where('in_use', '=', "S")->get();

        $workers = Worker::where('in_use', '=', "S")->orderby('name','asc')->get();

        $products = Product::where('in_use', '=', "S")->orderby('name','asc')->get();

        $accountings = Accounting::where('in_use', '=', "S")->get();


        $fertilizer_inventorys = Fertilizer_inventory::all();

        $account = new \App\Models\Account([

            ]);


        $product_apply = new \App\Models\Product_apply([

        ]);

        return view('product.product_apply.create',compact('product_apply','product_applys','account','grounds','accountings','workers','products'));
       
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

         $data = $this->validateRequest();
         
         $dataAccount['date' ] = $request['date'];
         $date['note'] = $request['note'];
         


        if ($request['note'] == null){
            $request['note'] = "...";
         }

         $data = $this->validateRequest();

         
         $dataAccount['date' ] = $request['date'];
         $date['note'] = $request['note'];
         
         $dataAccount['date'] = $request['date'];


        // captura json do produto selecionado
        $product = ($data['product']);
        // tranforma o produto em array
        $product = json_decode($product);
        // seleciona o nome
        $product_apply_description = $product->name;
        $data['product_id'] = $product->id;
        $data['name'] = $product->name;
       // dd($data['name']);
        $product_price = $product->price_unit;
        $product_unity = $product->unity;

    ////===================Inicio atualizacao do estoque =======================

    //    Montando o array do Estoque de fertilisante
 
        $fertilizer_inventory = Fertilizer_inventory::where('product_id', '=' , $data['product_id'])->get()->toArray();

      //  dd($fertilizer_inventory);

        if ($fertilizer_inventory ==[]){
            return redirect()
            ->back()
            ->with('error',  'O Produto ## '. $data['name'] .  ' ## não consta do Estoque. Cadastrar para continuar!!');
         }

        $fertilizerInventory = $fertilizer_inventory;

        $dataInventory = Arr::pull($fertilizerInventory, 0);


        $dataInventory['date'] =  $dataAccount['date'];
        $dataInventory['exit'] = $dataInventory['exit'] + $data['amount'];      
        $dataInventory['balance'] =  $dataInventory['entry'] - $dataInventory['exit'];
 

        $updateFertilizer_inventory =  DB::table('fertilizer_inventories')->where('product_id', '=' , $data['product_id'])->update($dataInventory);

        if (!$updateFertilizer_inventory){

        return redirect()
                    ->back()
                    ->with('error',  'Falha na atualização da atividade');     

      }

///========================Fim atualizacao do estoque========================///


      $dataAccount['date' ] = $dataAccount['date'];
      $dataAccount['description' ] = $product_apply_description;
      $dataAccount['type_account_id'] = $data['type_account_id'];
      $dataAccount['accounting_id'] = $data['accounting_id'];
      $dataAccount['ground_id'] = $data['ground_id'];
      $dataAccount['amount'] = $data['amount'] * $product_price;;
      $dataAccount['volume_lt'] = $data['volume_lt'];
      $dataAccount['origin'] = "P";
      $dataAccount['note' ] = $data['note'];


      $account = new account();
    
      $account->storeAccount($dataAccount);

      /// ==> veja se da para incluir um response para garantir
      ///     a integridade dos dados

      $id = DB::getPdo()->lastInsertId();

   // dd($dataAccount);

         $data['account_id'] = $id;

  
      /// criar e carregar o registro de atividade usar
      // o $id para o account_id criandp o relacionamento

        $product_apply = new product_apply();
    
        $response = $product_apply->storeProduct_apply($data);

      
        
        if ($response)

        return redirect()
                        ->route('product_apply.create')
                        ->with('sucess', 'Aplicação Cadastrada com sucesso!!!');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha ao cadastrar da venda');


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product_apply $product_apply)
    {

        return view('product.product_apply.show', compact('product_apply' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_apply $product_apply) {


        $user = auth()->user();

        $accounts = auth()->user()->account()->get();

      //  $product_applies = auth()->user()->product_apply()->get();

        $grounds = Ground::where('in_use', '=', "S")->get();

        $workers = Worker::where('in_use', '=', "S")->orderby('name','asc')->get();

        $products = Product::where('in_use', '=', "S")->orderby('name','asc')->get();

        $accountings = Accounting::where('in_use', '=', "S")->get();

    


        return view('product.product_apply.edit',compact('product_apply','accounts','grounds','accountings','workers','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_apply $product_apply, Account $account)
    {

     // dd($request['id'],$product_apply,$account);


        if ($request['date'] == null){
            $dataP = explode('/',$product_apply->date);
            $request['date'] = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];
         }

         if ($request['note'] == null){
            $request['note'] = "...";
         }

       

        $dataRequest = $this->validateRequest();

       // dd($dataRequest);

         // captura json do produto selecionado
         $product = ($dataRequest['product']);
         // tranforma o produto em array
         $product = json_decode($product);
         // seleciona o nome
         $product_apply_description = $product->name;
         $dataRequest['product_id'] = $product->id;
         $product_price = $product->price_unit;
         $product_unity = $product->unity;

        $dataAccount['date' ] = $request['date'];
        $date['note'] = $request['note'];
     
       // dd($type_product_apply_description);

       $dataAccount['date' ] = $request['date'];

      //  dd($dataAccount['date' ]);
    

        $dataProduct_apply['date']                 = $dataRequest['date'];
        $dataProduct_apply['product_id']           = $dataRequest['product_id'];  
        $dataProduct_apply['worker_id']            = $dataRequest['worker_id'];
        $dataProduct_apply['accounting_id']        = $dataRequest['accounting_id'];
        $dataProduct_apply['ground_id']            = $dataRequest['ground_id'];
        $dataProduct_apply['amount']               = $dataRequest['amount'];
        $dataProduct_apply['volume_lt']            = $dataRequest['volume_lt'];
        $dataProduct_apply['note']                 = $dataRequest['note'];
  
        //dd($dataProduct_apply);
        
       $updateProduct_apply = $product_apply -> update($dataProduct_apply);


        $dataAccount['date' ] = $dataRequest['date'];
        $dataAccount['description' ] = $product_apply_description;
        $dataAccount['type_account_id'] = $dataRequest['type_account_id'];
        $dataAccount['accounting_id'] = $dataRequest['accounting_id'];
        $dataAccount['ground_id'] = $dataRequest['ground_id'];
        $dataAccount['amount'] = $dataRequest['amount'] * $product_price;
        $dataAccount['volume_lt'] = $dataRequest['volume_lt'];
        $dataAccount['origin'] = "P";
        $dataAccount['note' ] = $dataRequest['note'];

     //  dd($dataAccount);

        $updateAccount = $product_apply->account ->update($dataAccount);


       $updateProduct_apply = $product_apply -> update($dataProduct_apply);

       if ($updateProduct_apply)

        return redirect()
                        ->route('product_apply.edit' ,[ 'product_apply' => $product_apply->id ])
                        ->with('sucess', 'Atualização realizada, confirme a necessidade de ajustar o estoque!!!');
                    

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
    public function destroy(Product_apply $product_apply, Account $account)
    {
        $product_apply->delete();
        $product_apply->account->delete();

        return redirect()
                ->route('product_apply.index')
                ->with('sucess', 'Deleção realizada, confirme a necessidade de ajustar o estoque!!!');
        
    }

 // atualização dos preços dos fertilizantes 

    public function update_price()
    {

      $accounts = Account::all();

      $product_applys = Product_apply::all();

      $products = Product::all();


      foreach($product_applys as $product_apply){

        $dataRequest = $product_apply;
      //  $dataAccount = $product_apply->account;

       // dd($product_apply->account);

        $dataP = explode('/',$product_apply->date);
        $data = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];
        $product_apply_description = $product_apply->product->name;
       // dd($product_apply_description);

       if ($dataRequest['note'] == null){
          $dataRequest['note'] = "...";
       }
       
        $product_price = $product_apply->product->price_unit;

        $dataProduct_apply['date']                 = $data;
        $dataProduct_apply['product_id']           = $dataRequest['product_id'];  
        $dataProduct_apply['worker_id']            = $dataRequest['worker_id'];
        $dataProduct_apply['accounting_id']        = $dataRequest['accounting_id'];
        $dataProduct_apply['ground_id']            = $dataRequest['ground_id'];
        $dataProduct_apply['amount']               = $dataRequest['amount'];
        $dataProduct_apply['volume_lt']            = $dataRequest['volume_lt'];
        $dataProduct_apply['note']                 = $dataRequest['note'];


        $updateProduct_apply = $product_apply -> update($dataProduct_apply);

        $dataAccount['date' ] = $data;
        $dataAccount['description' ] = $product_apply_description;
        $dataAccount['type_account_id'] = 1;
        $dataAccount['accounting_id'] = $dataRequest['accounting_id'];
        $dataAccount['ground_id'] = $dataRequest['ground_id'];
        $dataAccount['amount'] = $dataRequest['amount'] * $product_price;
        $dataAccount['volume_lt'] = $dataRequest['volume_lt'];
        $dataAccount['origin'] = "P";
        $dataAccount['note' ] = $dataRequest['note'];


        $updateAccount = $product_apply->account->update($dataAccount);

      };

  
       if ($updateProduct_apply)

        return redirect()
                        ->route('product_apply.index' )
                        ->with('sucess', 'Atualização realizada, confirme a necessidade de ajustar o estoque');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha na atualização da atividade');     

    }


    private function validateRequest()
    {

        return request()->validate([
             

         //   'user_id'               =>   'required',
            'date'                  =>   'required',
            'product'               =>   'required',
            'worker_id'             =>   'required',
            'ground_id'             =>   'required',
            'accounting_id'         =>   'required', 
            'amount'                =>   'required',
            'volume_lt'             =>   'required',
            'note'                  =>   'required',
            'type_account_id'       =>   'required',
            'origin'                =>   'required'


    
       ]);


    } 
}
