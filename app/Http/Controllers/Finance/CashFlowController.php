<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\User;
use Cookie;
use App\Models\CashFlow;
use App\Models\Bank;
use Carbon\Carbon;
use Redirect;

class CashFlowController extends Controller
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

    $user = auth()->user();

    //dd($user['id']);

    if ($user['id']<10){
   
        $banks = Bank::all();

        $cashFlows = auth()->user()->cashFlow()->orderBy('date')->get();

    //  dd($cashFlows);
    // $cashFlows = CashFlow::all();


        $response = $cashFlows->first();
        $last = $cashFlows->last();
    
    if($last!=null){ 
        $nr = $last['id'];

        if($nr>5):
            $nr = $nr-5;
            $cashFlows = auth()->user()->cashFlow()->orderBy('date')->get();
          //  dd($cashFlows);
        else:  
            $cashFlows = auth()->user()->cashFlow()->orderBy('date')->get();
        endif;
        }
    }
    
    else{

            return view('admin.home.index');
    }
 


    if ($response === null) {
        
    
        return view('/finance.cashflow.index',compact('cashFlows','banks'));
    } 
    
 
        return view('finance.cashflow.index',compact('cashFlows','banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = auth()->user();

       

            $banks = auth()->user()->cashFlow()->get();

            $cashFlows = auth()->user()->cashFlow()->get();
    
            $cashFlow = new \App\Models\CashFlow([

            ]);

            return view('finance.cashflow.create',compact('cashFlows','banks'));
       
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


        $cashFlows = auth()->user()->cashFlow()->orderBy('date')->get();

        $data = $request;

      //  dd($data);


        if ($data['note'] == null){
            $data['note'] = "...";
         }

         

         $last = $cashFlows->last();

         if ($last == null){
            $data['balance'] = 0;
            $last['balance'] = 0;
         }

         $data['balance'] = $last['balance'] + $request['amount'];
         
        $data = $this->validateRequest();

    //     dd($data);


        $cashFlow = new cashFlow();

        $response = $cashFlow->storeCashFlow($data);

        if ($response['sucess'])

            return redirect()
                        ->route('cashFlow.index')
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
    public function show(CashFlow $cashFlow)
    {
        $banks = auth()->user()->cashFlow()->get();

        return view('finance.cashflow.show', compact('cashFlow','banks' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CashFlow $cashFlow) {


        $user = auth()->user();
        
/// o menor que 10 é temporario a logica tem que ser melhorada

        if ($user['id']<10){

        $banks = Bank::all();

      //  dd($cashFlow, $banks);

        return view('finance.cashflow.edit',compact('cashFlow','banks'));

    }

        else{

        return view('admin.home.index');
 
}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CashFlow $cashFlow)
    {  

        if ($request['date'] == null){
            $dataP = explode('/',$cashFlow->date);
            $request['date'] = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];
        }

        if ($request['note'] == null){
            $request['note'] = "...";
         }

// calcular o balance

         $request['balance'] = $cashFlow['balance'];
                       
        $dataRequest = $this->validateRequest();

     //   dd($datarequest);

    

        $data['date']                = $dataRequest['date'];
        $data['description']        = $dataRequest['description'];
        $data['bank_id']            = $dataRequest['bank_id'];
        $data['amount']             = $dataRequest['amount'];
        $data['balance']            = $dataRequest['balance'];
        $data['note']               = $dataRequest['note'];
    

       //dd($data);

        $cashFlow -> update($data);



        return redirect('/cashFlow');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashFlow $cashFlow)
    {

        //dd($cashFlow);       
        $cashFlow->delete();

        return redirect('/cashFlow');
    }

    private function validateRequest()
    {

        return request()->validate([
            
            'date'                  => 'required' ,
            'description'           => 'required' ,
            'bank_id'               => 'required' ,
            'amount'                => 'required' ,
            'balance'                => 'required',
            'note'                  => 'required' ,
    
       ]);


    }
}
