<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Models\Account;
use Redirect;

class AccountController extends Controller
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
   
    $accounts = auth()->user()->account()->get();

    $response = $accounts->first();

    //dd($response);

    

    
    if ($response === null) {

        $account = new account();
    
        return view('finance.account.index',compact('accounts','account'));
    }    

  //dd($account->date);

   

        return view('finance.account.index',compact('accounts'));
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


        $account = new \App\Models\Account([

        ]);

    
        return view('finance.account.create',compact('accounts'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        $data = $request->all();

        //dd($data);

        $data['user_id'] = auth()->user()->id;

        //$data['date'] = null;

        if($data['note'] === null)
            $data['note'] = "";

        $string = 'true';
        $data['active'] = settype($string, 'boolean');


     // dd($data, $data['date']);
       // $data = $this->validateRequest();

        $account = new account();

        //dd($account,$data);
        //Chamando a objeto a funcao do model despesa e passando o array 
        // capiturado no formulario da view financeiro/despesa
        
        $response = $account->storeAccount($data);

        //dd($response);

        if ($response['sucess'])

            return redirect()
                        ->route('account.index')
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


        return view('finance.account.show', compact('account' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account) {


        $user = auth()->user();


        return view('finance.account.edit',compact('account'));
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

        $dataRequest = $request; 

        

        if ($dataRequest['date'] == null){
            $dataP = explode('/',$account->date);
            $data['date'] = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];
         }
         else {           
            $data['date'] = $dataRequest['date'];
         }

         if($dataRequest['note'] === null)
                $data['note'] = "";

        $string = 'true';
        $dataRequest['active'] = settype($string, 'boolean');

  
        $data['description']     = $dataRequest['description'];
        $data['type']            = $dataRequest['type'];
        $data['accounting']      = $dataRequest['accounting'];
        $data['crop']            = $dataRequest['crop'];
        $data['amount']          = $dataRequest['amount'];
    

       //dd($data);

        $account -> update($data);

        return redirect('/account');

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

        return redirect('/account');
    }

    private function validateRequest()
    {

        return request()->validate([
            
            'date'                  => 'required' ,
            'description'           => 'required' ,
            'type'                  => 'required' ,
            'accounting'            => 'required' ,
            'crop'                  => 'required' ,
            'amount'                => 'required' ,
            'active'                => 'required' ,
            'note'                  => 'required' ,
    
       ]);


    }
}
