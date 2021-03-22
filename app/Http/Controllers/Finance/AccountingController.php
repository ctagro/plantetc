<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Models\Accounting;
use Carbon\Carbon;
use Redirect;

class AccountingController extends Controller
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

    $accountings = auth()->user()->accounting()->get();


    // $accountings = Accounting::all();

    // dd($accountings);   

        return view('finance.accounting.index', ['accountings' => $accountings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();

        $accounting = new \App\Models\Accounting([


        ]);

        return view('finance.accounting.create',compact('accounting'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Accounting $accounting)
    {
        $data = $this->validateRequest();


        if ($request->file('image') === null){
            $data['image'] = 'accounting_avatar.png';
            }
        else{
            if ($request->file('image')->isValid() && $request->file('image')->isValid()) {
          
            //cria um nome para a imagem concatenado id e nome do user
                $name = 'accounting_'.time();   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $data['image'] = $nameFile;
               
               $upload = $request->file('image')->storeAs('accountings', $nameFile);
            }
        }


        $accounting = new accounting();

        

        //dd($accounting);

       

        // Chamando a objeto a funcao do model despesa e passando o array 
        // capiturado no formulario da view financeiro/despesa

        $response = $accounting->storeAccounting($data);



        if ($response)

            return redirect()
                            ->route('accounting.create')
                            ->with('sucess', 'Cadastro realizado com sucesso');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha ao cadastrar o funcionário');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Accounting $accounting)
    {

      //  $user_login_id = auth()->user()->id;
      //  $user = auth()->user();

      $accountings = auth()->user()->accounting()->get();


        return view('finance.accounting.show', compact('accounting' ));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Accounting $accounting) {


        $user = auth()->user();


        return view('finance.accounting.edit',['accounting' => $accounting]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accounting $accounting)
    {


        $dataRequest = $this->validateRequest();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $nameFile = $accounting['image'];
              
            if  ($nameFile == "accounting_avatar.png"){
    
                //cria um nome para a imagem concatenado id e nome do user
                $name = 'accounting_'.time();   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $accounting['image'] = $nameFile;
                //dd($nameFile);
            }
        
            $upload = $request->file('image')->storeAs('accountings', $nameFile);
        }

        

        $data['name'] = $dataRequest['name'];
        $data['description'] = $dataRequest['description'];
       

        $update = $accounting -> update($data);

        if ($update)

        return redirect()
                        ->route('accounting.edit' ,[ 'accounting' => $accounting->id ])
                        ->with('sucess', 'Sucesso ao atualizar');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha na atualização do cadastro');     

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accounting $accounting)
    {
        $path = 'accountings/'.$accounting['image'];

        if($path != "accountings/accounting_avatar.png")

        Storage::delete($path);

        $destroy = $accounting->delete();

        return redirect('/accounting');
    }

    private function validateRequest()
    {

        return request()->validate([

            'name'=> 'required',
            'description'=> 'required',
          //  'activity'=> 'required',
    
       ]);


    }
}
