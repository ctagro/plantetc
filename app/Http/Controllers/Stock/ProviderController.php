<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Models\Provide;

class ProviderController extends Controller
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

    $provides = auth()->user()->provide()->get();


        return view('stock.provide.index', ['provides' => $provides]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();
       

        $provide = new \App\Models\Provide([


        ]);

        return view('stock.provide.create',compact('provide'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Provide $provide)
    {
        if ($request['note'] == null){
            $request['note'] = "...";
         }

         $data1 = $request;

        // dd($data1);

        $data = $this->validateRequest();

 
        if ($request->file('image') === null){
            $data['image'] = 'provide_avatar.png';
            }
        else{
            if ($request->file('image')->isValid() && $request->file('image')->isValid()) {
          
            //cria um nome para a imagem concatenado id e nome do user
                $name = 'provide_'.time();   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $data['image'] = $nameFile;
               //dd($data['image']);

               $upload = $request->file('image')->storeAs('provides', $nameFile);
            }

        }
     
        $provide = new provide();

        // Chamando a objeto a funcao do model  e passando o array 
        // capiturado no formulario da view 

        $response = $provide->storeprovide($data);

        if ($response)

        return redirect()
                        ->route('provide.create')
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
    public function show(provide $provide)
    {

        return view('stock.provide.show', compact('provide' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(provide $provide) {


        $user = auth()->user();


        return view('stock.provide.edit',['provide' => $provide]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provide $provide)
    {

       $dataRequest = $request; 

    if ($request->hasFile('image') && $request->file('image')->isValid()) {

        $nameFile = $provide['image'];
          
        if  ($nameFile == "provide_avatar.png"){

            //cria um nome para a imagem concatenado id e nome do user
            $name = 'provide_'.time();   // tirar os espacos com o kebab_case
            $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
            $nameFile = "{$name}.{$extenstion}"; // concatenando
            $provide['image'] = $nameFile;
        }
    
        $upload = $request->file('image')->storeAs('provides', $nameFile);
    }

        $data['name']           = $dataRequest['name'];
        $data['adress']         = $dataRequest['adress'];
        $data['city']           = $dataRequest['city'];
        $data['province']       = $dataRequest['province'];
        $data['phone']          = $dataRequest['phone'];
        $data['salesman']       = $dataRequest['salesman']; 
        $data['note']           = $dataRequest['note'];
        $data['image']          = $provide['image'];
        $data['in_use']         = $dataRequest['in_use'];


  
    //dd($data);

      $update  = $provide -> update($data);

      if ($update)

        return redirect()
                        ->route('provide.edit' ,[ 'provide' => $provide->id ])
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
    public function destroy(provide $provide)
    {
         $path = 'provides/'.$provide['image'];

        if($path != "provides/provide_avatar.png")
            Storage::delete($path);

        $provide->delete();
      

        return redirect('/provide');
    }

    private function validateRequest()
    {

        return request()->validate([

        
            'name'              => 'required',
            'adress'            => 'required',
            'city'              => 'required',
            'province'          => 'required',
            'phone'             => 'required',
            'salesman'          => 'required', 
            'in_use'            => 'required',
            'note'              => 'required',
                      
       ]);

    }
}
