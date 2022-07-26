<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Models\Bayer;

class BayerController extends Controller
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

    $bayers = auth()->user()->bayer()->get();


        return view('finance.bayer.index', ['bayers' => $bayers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();
       

        $bayer = new \App\Models\Bayer([


        ]);

        return view('finance.bayer.create',compact('bayer'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Bayer $bayer)
    {
        if ($request['note'] == null){
            $request['note'] = "...";
         }

        $data = $this->validateRequest();

 
        if ($request->file('image') === null){
            $data['image'] = 'bayer_avatar.png';
            }
        else{
            if ($request->file('image')->isValid() && $request->file('image')->isValid()) {
          
            //cria um nome para a imagem concatenado id e nome do user
                $name = 'bayer_'.time();   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $data['image'] = $nameFile;
               //dd($data['image']); $upload = $request->file('image')->storeAs('bayers', $nameFile);
               $upload = $request->file('image')->storeAs('bayers', $nameFile);
            }

        }
     
        $bayer = new bayer();

        // Chamando a objeto a funcao do model  e passando o array 
        // capiturado no formulario da view 

        $response = $bayer->storebayer($data);

        if ($response)

        return redirect()
                        ->route('bayer.create')
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
    public function show(bayer $bayer)
    {

        return view('finance.bayer.show', compact('bayer' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(bayer $bayer) {


        $user = auth()->user();


        return view('finance.bayer.edit',['bayer' => $bayer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bayer $bayer)
    {

       $dataRequest = $request; 

    if ($request->hasFile('image') && $request->file('image')->isValid()) {

        $nameFile = $bayer['image'];
          
        if  ($nameFile == "bayer_avatar.png"){

            //cria um nome para a imagem concatenado id e nome do user
            $name = 'bayer_'.time();   // tirar os espacos com o kebab_case
            $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
            $nameFile = "{$name}.{$extenstion}"; // concatenando
            $bayer['image'] = $nameFile;
        }
    
        $upload = $request->file('image')->storeAs('bayers', $nameFile);
    }

    $data['name']           = $dataRequest['name'];
    $data['note']           = $dataRequest['note'];
    $data['image']          = $bayer['image'];
    $data['in_use']         = $dataRequest['in_use'];
  
    //dd($data);

      $update  = $bayer -> update($data);

      if ($update)

        return redirect()
                        ->route('bayer.edit' ,[ 'bayer' => $bayer->id ])
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
    public function destroy(bayer $bayer)
    {
         $path = 'bayers/'.$bayer['image'];

        if($path != "bayers/bayer_avatar.png")
            Storage::delete($path);

        $bayer->delete();
      

        return redirect('/bayer');
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
