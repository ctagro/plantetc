<?php

namespace App\Http\Controllers\Pesticide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\User;
use App\Models\Pesticide;
Use App\Models\Worker;
use App\Models\Ground;
use App\Models\Pesticide_apply;
use App\Models\Account;
use App\Models\Accounting;
use App\Models\Pesticide_inventory;

class Pesticide_applyController extends Controller
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

 // dd($pesticide_applys);


        return view('pesticide.pesticide_apply.index',compact('pesticide_applys'));
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

      // $pesticide_applys = auth()->user()->pesticide_apply()->get();
        $grounds = Ground::where('in_use', '=', "S")->get();

        $workers = Worker::where('in_use', '=', "S")->orderby('name','asc')->get();

        $pesticides = Pesticide::where('in_use', '=', "S")->orderby('name','asc')->get();

        $accountings = Accounting::where('in_use', '=', "S")->get();


        $account = new \App\Models\Account([

            ]);

        //  dd($account);

    //    $pesticide_apply = new \App\Models\Pesticide_apply([

    //    ]);

    $pesticide_apply = new pesticide_apply();

    //dd($pesticide_apply);

   
        return view('pesticide.pesticide_apply.create',compact('pesticide_apply','account','grounds','accountings','workers','pesticides'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

     // $data = $request;
     //  dd($data["pesticide"]);

        if ($request['note'] == null){
            $request['note'] = "...";
         }

         $data = $this->validateRequest();

       //  dd($data);
         
         $dataAccount['date' ] = $request['date'];
         $date['note'] = $request['note'];
         
        // dd($data["pesticide"]);

        // captura json do produto selecionado
        $pesticide = ($data["pesticide"]);
        // tranforma o produto em array
        $pesticide = json_decode($pesticide);
        // seleciona o nome

       $data['name'] = $pesticide->name;

        $pesticide_apply_description = $pesticide->name;
        $data['pesticide_id'] = $pesticide->id;
        $pesticide_price = $pesticide->price_unit;
        $pesticide_unity = $pesticide->unity;

////===================Inicio atualizacao do estoque =======================

    //=========   Captura o registro do estoque relacionado
 
    $pesticide_inventory = Pesticide_inventory::where('pesticide_id', '=' , $data['pesticide_id'])->first();

    //============= testa se o pesticida já esta cadastrado no estoque
    //============= se nao: informa que o pesticida deve ser cadastrado no estoque

    if (is_null($pesticide_inventory)){
          return redirect()
          ->back()
          ->with('sucess', 'O Defensivo ## '. $data['name'] .  ' ## não consta do Estoque. Cadastrar para continuar!!');
       }

    //============= cria array espelho do registro para alteracao dos devidos campos

       $dataInventory = $pesticide_inventory->toArray();

    // dd($dataInventory,(1.10 * $dataInventory['minimum_stock']));

    // calcula e altera os devidos campos do estoque

      $dataInventory['date'] =  $dataAccount['date'];
      $dataInventory['exit'] = $dataInventory['exit'] + $data['amount'];      
      $dataInventory['balance'] =  $dataInventory['entry'] - $dataInventory['exit'];

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
      
      
     // dd($dataInventory['balance'],$dataInventory['minimum_stock'],$dataInventory['status']);
                  //  dd($pesticide_inventory,$dataInventory['id']);

      //=========Atualizar estoque==============


      $updateFertilizer_inventory =  DB::table('pesticide_inventories')->where('id', '=' , $dataInventory['id'])->update($dataInventory);

      if (!$updateFertilizer_inventory){

      return redirect()
                  ->back()
                  ->with('error',  'Falha na atualização da atividade');     

    }

///========================Fim atualizacao do estoque========================///

       $dataAccount['date' ] = $request['date'];

 
      $dataAccount['date' ] = $data['date'];
      $dataAccount['description' ] = $pesticide_apply_description;
      $dataAccount['type_account_id'] = $data['type_account_id'];
      $dataAccount['accounting_id'] = $data['accounting_id'];
      $dataAccount['ground_id'] = $data['ground_id'];
      $dataAccount['amount'] = $data['amount'] * $pesticide_price;
      $dataAccount['volume_lt'] = $data['volume_lt'];
      $dataAccount['origin'] = "P";
      $dataAccount['note' ] = $data['note'];


      $account = new account();
    
      $account->storeAccount($dataAccount);

      /// ==> veja se da para incluir um response para garantir
      ///     a integridade dos dados

      $id = DB::getPdo()->lastInsertId();

 //   dd($id);

         $data['account_id'] = $id;

   //   dd($data);
      ////// parei aqui /////////////

      /// criar e carregar o registro de atividade usar
      // o $id para o account_id criandp o relacionamento

        $pesticide_apply = new pesticide_apply();

      //dd($pesticide_apply,$data);
    
        $response = $pesticide_apply->storePesticide_apply($data);

      
        
        if ($response)

        return redirect()
                        ->route('pesticide_apply.create')
                        ->with('sucess', 'Cadastro realizado com sucesso');
                    

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
    public function show(Pesticide_apply $pesticide_apply)
    {

        return view('pesticide.pesticide_apply.show', compact('pesticide_apply' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesticide_apply $pesticide_apply) {

        


        $user = auth()->user();

        $accounts = auth()->user()->account()->get();

      //  $pesticide_applies = auth()->user()->pesticide_apply()->get();

        $grounds = Ground::where('in_use', '=', "S")->get();

        $workers = Worker::where('in_use', '=', "S")->orderby('name','asc')->get();

        $pesticides = Pesticide::where('in_use', '=', "S")->orderby('name','asc')->get();

        $accountings = Accounting::where('in_use', '=', "S")->get();

    


        return view('pesticide.pesticide_apply.edit',compact('pesticide_apply','accounts','grounds','accountings','workers','pesticides'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pesticide_apply $pesticide_apply, Account $account)
    {


        if ($request['date'] == null){
            $dataP = explode('/',$pesticide_apply->date);
            $request['date'] = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];
         }

         if ($request['note'] == null){
            $request['note'] = "...";
         }

       

        $dataRequest = $this->validateRequest();

       // dd($dataRequest);

         // captura json do produto selecionado
         $pesticide = ($dataRequest['pesticide']);
         // tranforma o produto em array
         $pesticide = json_decode($pesticide);
         // seleciona o nome
         $pesticide_apply_description = $pesticide->name;
         $dataRequest['pesticide_id'] = $pesticide->id;
         $pesticide_price = $pesticide->price_unit;
         $pesticide_unity = $pesticide->unity;

        $dataAccount['date' ] = $request['date'];
        $date['note'] = $request['note'];
     
       // dd($type_pesticide_apply_description);

       $dataAccount['date' ] = $request['date'];

      //  dd($dataAccount['date' ]);
    

        $dataPesticide_apply['date']                 = $dataRequest['date'];
        $dataPesticide_apply['pesticide_id']         = $dataRequest['pesticide_id'];  
        $dataPesticide_apply['worker_id']            = $dataRequest['worker_id'];
        $dataPesticide_apply['accounting_id']        = $dataRequest['accounting_id'];
        $dataPesticide_apply['ground_id']            = $dataRequest['ground_id'];
        $dataPesticide_apply['amount']               = $dataRequest['amount'];
        $dataPesticide_apply['volume_lt']            = $dataRequest['volume_lt'];
        $dataPesticide_apply['note']                 = $dataRequest['note'];
  
      //  dd($dataPesticide_apply);
        
       $updatePesticide_apply = $pesticide_apply -> update($dataPesticide_apply);


        $dataAccount['date' ] = $dataRequest['date'];
        $dataAccount['description' ] = $pesticide_apply_description;
        $dataAccount['type_account_id'] = $dataRequest['type_account_id'];
        $dataAccount['accounting_id'] = $dataRequest['accounting_id'];
        $dataAccount['ground_id'] = $dataRequest['ground_id'];
        $dataAccount['amount'] = $dataRequest['amount'] * $pesticide_price;;
        $dataAccount['volume_lt'] = $dataRequest['volume_lt'];
        $dataAccount['origin'] = "P";
        $dataAccount['note' ] = $dataRequest['note'];

      // dd($dataAccount);

        $updateAccount = $pesticide_apply->account ->update($dataAccount);


       $updatePesticide_apply = $pesticide_apply -> update($dataPesticide_apply);

       if ($updatePesticide_apply)

        return redirect()
                        ->route('pesticide_apply.edit' ,[ 'pesticide_apply' => $pesticide_apply->id ])
                        ->with('sucess', 'Sucesso ao atualizar');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha na atualização da atividade');     

    }

    // atualização dos preços dos fertilizantes 

    public function update_price()
    {

      $accounts = Account::all();

      $pesticide_applys = Pesticide_apply::all();

      $pesticides = Pesticide::all();


      foreach($pesticide_applys as $pesticide_apply){

        $dataRequest = $pesticide_apply;
     

       // dd($pesticide_apply->account);

        $dataP = explode('/',$pesticide_apply->date);
        $data = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];
        $pesticide_apply_description = $pesticide_apply->pesticide->name;
       // dd($pesticide_apply_description);

       if ($dataRequest['note'] == null){
          $dataRequest['note'] = "...";
       }
       
        $pesticide_price = $pesticide_apply->pesticide->price_unit;

        $dataPesticide_apply['date']                 = $data;
        $dataPesticide_apply['pesticide_id']          = $dataRequest['pesticide_id'];  
        $dataPesticide_apply['worker_id']            = $dataRequest['worker_id'];
        $dataPesticide_apply['accounting_id']        = $dataRequest['accounting_id'];
        $dataPesticide_apply['ground_id']            = $dataRequest['ground_id'];
        $dataPesticide_apply['amount']               = $dataRequest['amount'];
        $dataPesticide_apply['volume_lt']            = $dataRequest['volume_lt'];
        $dataPesticide_apply['note']                 = $dataRequest['note'];


        $updatePesticide_apply = $pesticide_apply -> update($dataPesticide_apply);

        $dataAccount['date' ] = $data;
        $dataAccount['description' ] = $pesticide_apply_description;
        $dataAccount['type_account_id'] = 1;
        $dataAccount['accounting_id'] = $dataRequest['accounting_id'];
        $dataAccount['ground_id'] = $dataRequest['ground_id'];
        $dataAccount['amount'] = $dataRequest['amount'] * $pesticide_price;
        $dataAccount['volume_lt'] = $dataRequest['volume_lt'];
        $dataAccount['origin'] = "P";
        $dataAccount['note' ] = $dataRequest['note'];

      

        $updateAccount = $pesticide_apply->account->update($dataAccount);


      };

       if ($updatePesticide_apply)

        return redirect()
                        ->route('pesticide_apply.index' )
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
    public function destroy(Pesticide_apply $pesticide_apply, Account $account)
    {
        $pesticide_apply->delete();
        $pesticide_apply->account->delete();

        return redirect()
        ->route('pesticide_apply.index')
        ->with('sucess', 'Deleção realizada, confirme a necessidade de ajustar o estoque!!!');

    }

    private function validateRequest()
    {

        return request()->validate([
             

         //   'user_id'               =>   'required',
            'date'                  =>   'required',
            'pesticide'             =>   'required',
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
