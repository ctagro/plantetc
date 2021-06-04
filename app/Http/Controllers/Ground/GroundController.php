<?php

namespace App\Http\Controllers\Ground;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Activity;
use App\User;
use App\Models\Ground;
use Redirect;

class GroundController extends Controller
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

    $grounds = auth()->user()->ground()->get();


    // $grounds = Ground::all();

    // dd($grounds);   

        return view('ground.ground.index', ['grounds' => $grounds]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();

        $ground = new \App\Models\Ground([


        ]);

        return view('ground.ground.create',compact('ground'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Ground $ground)
    {
        $data = $this->validateRequest();

        if ($request->file('image') === null){
            $data['image'] = 'ground_avatar.png';
            }
        else{
            if ($request->file('image')->isValid() && $request->file('image')->isValid()) {
          
            //cria um nome para a imagem concatenado id e nome do user
                $name = 'ground_'.time();   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $data['image'] = $nameFile;
               
               $upload = $request->file('image')->storeAs('grounds', $nameFile);
            }
        }


        $ground = new ground();

        

        //dd($ground);

       

        // Chamando a objeto a funcao do model despesa e passando o array 
        // capiturado no formulario da view financeiro/despesa

        $response = $ground->storeGround($data);



        if ($response)

            return redirect()
                            ->route('ground.create')
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
    public function show(ground $ground)
    {

      //  $user_login_id = auth()->user()->id;
      //  $user = auth()->user();

      $grounds = auth()->user()->ground()->get();


        return view('ground.ground.show', compact('ground' ));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ground $ground) {


        $user = auth()->user();


        return view('ground.ground.edit',['ground' => $ground]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ground $ground)
    {

        $dataRequest = $this->validateRequest();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $nameFile = $ground['image'];
              
            if  ($nameFile == "ground_avatar.png"){
    
                //cria um nome para a imagem concatenado id e nome do user
                $name = 'ground_'.time();   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $ground['image'] = $nameFile;
                //dd($nameFile);
            }
        
            $upload = $request->file('image')->storeAs('grounds', $nameFile);
        }


        $data['name'] = $dataRequest['name'];
        $data['area'] = $dataRequest['area'];
        $data['location'] = $dataRequest['location'];
        $data['in_use']   = $dataRequest['in_use'];
       

        $update = $ground -> update($data);

        if ($update)

        return redirect()
                        ->route('ground.edit' ,[ 'ground' => $ground->id ])
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
    public function destroy(ground $ground)
    {
        $path = 'grounds/'.$ground['image'];

        if($path != "grounds/ground_avatar.png")

        Storage::delete($path);

        $destroy = $ground->delete();

        return redirect('/ground');
    }

    private function validateRequest()
    {

        return request()->validate([

            'name'      => 'required',
            'area'      => 'required',
            'location'  => 'required',
            'in_use'  => 'required',
    
       ]);


    }
}
