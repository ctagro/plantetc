<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Models\Bank;

class BankController extends Controller
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

   $banks = auth()->user()->bank()->get();
   // $banks = Bank::all();

   // dd($banks);


        return view('finance.bank.index', ['banks' => $banks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();
       

        $bank = new \App\Models\Bank([


        ]);

        return view('finance.bank.create',compact('bank'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Bank $bank)
    {
        if ($request['note'] == null){
            $request['note'] = "...";
         }

        $data = $this->validateRequest();

     
        $bank = new bank();

        // Chamando a objeto a funcao do model  e passando o array 
        // capiturado no formulario da view 

        $response = $bank->storebank($data);

        if ($response)

        return redirect()
                        ->route('bank.create')
                        ->with('sucess', 'Cadastro realizado com sucesso');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha ao cadastrar o tipo de atividade');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(bank $bank)
    {

        return view('finance.bank.show', compact('bank' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(bank $bank) {


        $user = auth()->user();


        return view('finance.bank.edit',['bank' => $bank]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {

       $dataRequest = $request; 

   
    $data['name']           = $dataRequest['name'];
    $data['note']           = $dataRequest['note'];
    $data['in_use']         = $dataRequest['in_use'];
  
    //dd($data);

      $update  = $bank -> update($data);

      if ($update)

        return redirect()
                        ->route('bank.edit' ,[ 'bank' => $bank->id ])
                        ->with('sucess', 'Sucesso ao atualizar');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha na atualização do tipo de atividade');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(bank $bank)
    {
  
        $bank->delete();
      

        return redirect('/bank');
    }

    private function validateRequest()
    {

        return request()->validate([

        
            'name'      => 'required',
            'note'      => 'required',
            'in_use'    => 'required',
            
            
       ]);

    }
}
