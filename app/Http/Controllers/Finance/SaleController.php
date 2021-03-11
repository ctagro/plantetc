<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\User;
use Cookie;
use App\Models\Account;
use App\Models\Accounting;
use App\Models\Ground;
use App\Models\Bayer;
Use App\Models\Type_account;
use Carbon\Carbon;
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
   
    $accounts = auth()->user()->account()->where('type_account_id', '=', 3)->get();

    $grounds = auth()->user()->ground()->get();

    $accountings = auth()->user()->accounting()->where('sale','S')->get();

    $bayers = auth()->user()->bayer()->get();

    $type_accounts= type_account::where('id', '=', 3)->get();


    $response = $accounts->first();


    if ($response === null) {

        $account = new account();
    
        return view('finance.sale.index',compact('accounts','account','grounds','accountings','bayers','type_accounts'));
    }    

  //dd($account->date);

   

        return view('finance.sale.index',compact('accounts','grounds','accountings','bayers','type_accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = auth()->user();

        $accounts = auth()->user()->account()->where('type_account_id', 3 )->get();

        $grounds = auth()->user()->ground()->get();

        $bayers = auth()->user()->bayer()->get();

        $accountings = auth()->user()->accounting()->whereRaw('sale' == 'S')->get();

        $type_accounts= type_account::where('id', '=', 3)->get();
  
        $account = new \App\Models\Account([

        ]);

        return view('finance.sale.create',compact('accounts','grounds','accountings','bayers','type_accounts'));
       
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

        
        $account = new account();

        $response = $account->storeAccount($data);

        if ($response['sucess'])

            return redirect()
                        ->route('sale.index')
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
    public function show(Account $account)
    {


        return view('finance.sale.show', compact('account' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account) {


        $user = auth()->user();

        $bayers = auth()->user()->bayer()->get();

        $grounds = auth()->user()->ground()->get();

        $accountings = auth()->user()->accounting()->where('sale','S')->get();

        $type_accounts= type_account::where('id', '=', 3)->get();

        return view('finance.sale.edit',compact('account','grounds','accountings','bayers','type_accounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {  

        if ($request['date'] == null){
            $dataP = explode('/',$account->date);
            $request['date'] = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];
        }

        if ($request['note'] == null){
            $request['note'] = "...";
         }
                       
        $dataRequest = $this->validateRequest();

        $data['date']            = $dataRequest['date'];
        $data['description']     = $dataRequest['description'];
        $data['type_account_id'] = $dataRequest['type_account_id'];
        $data['accounting_id']   = $dataRequest['accounting_id'];
        $data['ground_id']       = $dataRequest['ground_id'];
        $data['amount']          = $dataRequest['amount'];
        $data['note']            = $dataRequest['note'];
    

       //dd($data);

        $account -> update($data);



        return redirect('/sale');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {

        //dd($account);       
        $account->delete();

        return redirect('/sale');
    }

    private function validateRequest()
    {

        return request()->validate([
            
            'date'                  => 'required' ,
            'description'           => 'required' ,
            'type_account_id'       => 'required' ,
            'accounting_id'         => 'required' ,
            'ground_id'             => 'required' ,
            'amount'                => 'required' ,
            'note'                  => 'required' ,
    
       ]);


    }
}
