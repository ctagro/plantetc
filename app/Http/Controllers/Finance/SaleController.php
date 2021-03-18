<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Models\Sale;
Use App\Models\Type_account;
use App\Models\Ground;
use App\Models\Product;
use App\Models\Account;
use App\Models\Accounting;


use DateTime;
use Redirect;

class SaleController extends Controller
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
   
    $sales = auth()->user()->sale()->get();

    //dd($sales);

        return view('finance.sale.index',compact('sales'));
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

        $sales = auth()->user()->sale()->get();

        $grounds = auth()->user()->ground()->get();

        $products = product::where('type_product', '=', "S")->get();

        $bayers = auth()->user()->bayer()->get();

        $type_accounts = Type_account::all();

     //   $accountings = accounting::where('sale', '=', "S")->get();

    // dd($type_products);


        $account = new \App\Models\Account([

            ]);


        $sale = new \App\Models\Sale([

        ]);

   
        return view('finance.sale.create',compact('sale','sales','account','grounds','products','type_accounts','bayers'));
       
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
     

        // captura json do produto selecionado
        $product = ($data['product']);
        // tranforma o produto em array
        $product = json_decode($product);
        // seleciona o nome
        $sale_description = $product->name;
        $data['product_id'] = $product->id;
     //   dd($dataSalary_hour);
       // dd($sale_name);

       $dataAccount['date' ] = $request['date'];

      //dd($dataAccount['date' ]);
    
       
     //  $data = $this->validateRequest();

      // dd($data['worked_hours'],floatval($dataSalary[1]));

      //  $an = $data['worked_hours'] * floatval($dataSalary[1]);

       // dd($an);

    //.  dd($data);
   
   //   $dataAccount['user_id' ] = $data['user_id'];
      $dataAccount['date' ] = $data['date'];
      $dataAccount['description' ] = $sale_description;
      $dataAccount['type_account_id'] = $data['type_account_id'];
      $dataAccount['accounting_id'] = $data['accounting_id'];
      $dataAccount['ground_id'] = $data['ground_id'];
      $dataAccount['amount'] = $data['amount'] * $data['price_unit'];
      $dataAccount['activity'] = "N";
      $dataAccount['note' ] = $data['note'];

  //  dd($dataAccount);

      $account = new account();
    
      $account->storeAccount($dataAccount);

      /// ==> veja se da para incluir um response para garantir
      ///     a integridade dos dados

      $id = DB::getPdo()->lastInsertId();

 //   dd($id);

         $data['account_id'] = $id;

      //dd($data);
      ////// parei aqui /////////////

      /// criar e carregar o registro de atividade usar
      // o $id para o account_id criandp o relacionamento

        $sale = new sale();
    
        $response = $sale->storeSale($data);

      
        
        if ($response)

        return redirect()
                        ->route('sale.create')
                        ->with('sucess', 'Cadastro realizado com sucesso');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha ao cadastrar da atividade');


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {

        return view('finance.sale.show', compact('sale' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale) {


        $user = auth()->user();

        $accounts = auth()->user()->account()->get();

        $sales = auth()->user()->sale()->get();

        $grounds = auth()->user()->ground()->get();

        $products = auth()->user()->product()->get();

        $bayers = auth()->user()->bayer()->get();

        $type_accounts = Type_account::all();

        $account = account::where('id', '=', $sale->account_id)->get();
        
        $accountings = accounting::where('sale', '=', "S")->get();


        return view('finance.sale.edit',compact('sale','account','accountings','type_accounts','grounds','products','bayers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale, Account $account)
    {

        if ($request['date'] == null){
            $dataP = explode('/',$sale->date);
            $request['date'] = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];
         }

         if ($request['note'] == null){
            $request['note'] = "...";
         }

        // dd($request['note']);

        $dataRequest = $this->validateRequest();

         // captura json do produto selecionado
         $product = ($dataRequest['product']);
         // tranforma o produto em array
         $product = json_decode($product);
         // seleciona o nome
         $sale_description = $product->name;
         $dataRequest['product_id'] = $product->id;

        $dataAccount['date' ] = $request['date'];
        $date['note'] = $request['note'];
     
       // dd($type_sale_description);

       $dataAccount['date' ] = $request['date'];

      // dd($dataAccount['date' ]);
    

       //  $account = account::where('id', '=', $sale->account_id)->get();

        $dataSale['date']                    = $dataRequest['date'];
        $dataSale['type_account_id']      = $dataRequest['type_account_id'];
        $dataSale['ground_id']             = $dataRequest['ground_id'];
        $dataSale['product_id']             = $dataRequest['product_id'];
        $dataSale['amount']             = $dataRequest['amount'];
        $dataSale['unity']            = $dataRequest['unity'];
        $dataSale['price_unit']            = $dataRequest['price_unit'];
        $dataSale['bayer_id']          = $dataRequest['bayer_id'];
        $dataSale['note']                   = $dataRequest['note'];
  
      //  dd($dataSale);
        
       $updateSale = $sale -> update($dataSale);


        $dataAccount['date' ] = $dataRequest['date'];
        $dataAccount['description' ] = $sale_description;
        $dataAccount['type_account_id'] = $dataRequest['type_account_id'];
        $dataAccount['accounting_id'] = $dataRequest['accounting_id'];
        $dataAccount['ground_id'] = $dataRequest['ground_id'];
        $dataAccount['amount'] = $dataRequest['amount'] * $dataRequest['price_unit'];
        $dataAccount['activity'] = "N";
        $dataAccount['note' ] = $dataRequest['note'];

       // dd($dataAccount);

        $updateAccount = $sale->account ->update($dataAccount);


       $updateSale = $sale -> update($dataSale);

       if ($updateSale)

        return redirect()
                        ->route('sale.edit' ,[ 'sale' => $sale->id ])
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
    public function destroy(Sale $sale, Account $account)
    {
        $sale->delete();
        $sale->account->delete();

        return redirect('sale');
    }

    private function validateRequest()
    {

        return request()->validate([
             

            
            'date'               =>   'required',
       //     'date_delivery'     =>   'required',
            'product'         =>   'required',
            'ground_id'          =>   'required',
            'type_account_id'     =>   'required',
            'amount'             =>   'required',
            'unity'              =>   'required',
            'price_unit'         =>   'required',
            'bayer_id'           =>   'required',
      //      'transporter_id'    =>   'required',
      //      'cost_freight'      =>   'required',
            'note'               =>   'required',
            'accounting_id'        =>   'required',

    
       ]);


    }
}
