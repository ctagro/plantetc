<?php

namespace App\Http\Controllers\Pesticide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
use App\Models\Worker;
use App\Models\Account;
use App\Models\Accounting;
use App\Models\Ground;
use App\Models\Pesticide;
use App\Models\Product_apply;

class PesticideController extends Controller
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

    $pesticides = auth()->user()->pesticide()->get();

   // dd($pesticides);


    // $pesticides = pesticide::all();

    // dd($pesticides);   

        return view('pesticide.pesticide.index', ['pesticides' => $pesticides]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();

 //       $pesticide = new \App\Models\pesticide([
 //       ]);

       $pesticide = new pesticide();

        return view('pesticide.pesticide.create',compact('pesticide'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, pesticide $pesticide)
    {
        
        $data = $this->validateRequest();

        // dd($data);

        if ($request->file('image') === null){
            $data['image'] = 'pesticide_avatar.png';
            }
        else{
            if ($request->file('image')->isValid() && $request->file('image')->isValid()) {
          
            //cria um nome para a imagem concatenado id e nome do user
                $name = 'pesticide_'.time();   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $data['image'] = $nameFile;
               
               $upload = $request->file('image')->storeAs('pesticides', $nameFile);
            }
        }


        $pesticide = new pesticide();

        

        //dd($pesticide);

       

        // Chamando a objeto a funcao do model despesa e passando o array 
        // capiturado no formulario da view pesticideiro/despesa

        $response = $pesticide->storepesticide($data);



        if ($response)

            return redirect()
                            ->route('pesticide.create')
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
    public function show(pesticide $pesticide)
    {

      //  $user_login_id = auth()->user()->id;
      //  $user = auth()->user();

      $pesticides = auth()->user()->pesticide()->get();


        return view('pesticide.pesticide.show', compact('pesticide' ));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(pesticide $pesticide) {


        $user = auth()->user();


        return view('pesticide.pesticide.edit',['pesticide' => $pesticide]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pesticide $pesticide)
    {

        $dataRequest = $this->validateRequest();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $nameFile = $pesticide['image'];
              
            if  ($nameFile == "pesticide_avatar.png"){
    
                //cria um nome para a imagem concatenado id e nome do user
                $name = 'pesticide_'.time();   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $pesticide['image'] = $nameFile;
                //dd($nameFile);
            }
        
            $upload = $request->file('image')->storeAs('pesticides', $nameFile);

            if (!$upload)
            return redirect() 
                        ->back()
                        ->with('error', 'Falha ao fazer o upload');
        }

        

        $data['name']               = $dataRequest['name'];
        $data['description']        = $dataRequest['description'];
        $data['active_principle']   = $dataRequest['active_principle'];
        $data['carencia']           = $dataRequest['carencia'];
        $data['dosagem']            = $dataRequest['dosagem'];
        $data['indicacoes']         = $dataRequest['indicacoes'];
        $data['type_pesticide']     = $dataRequest['type_pesticide'];
        $data['packing']            = $dataRequest['packing'];
        $data['unity']              = $dataRequest['unity'];
        $data['manufacturer']       = $dataRequest['manufacturer'];
        $data['price']              = $dataRequest['price'];
        $data['price_unit']         = $dataRequest['price_unit'];
        $data['note']               = $dataRequest['note'];
        $data['in_use']             = $dataRequest['in_use'];
       

        $update = $pesticide -> update($data);

        if ($update);

        return redirect()
                        ->route('pesticide.edit' ,[ 'pesticide' => $pesticide->id ])
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
    public function destroy(pesticide $pesticide)
    {
        $path = 'pesticides/'.$pesticide['image'];

        if($path != "pesticides/pesticide_avatar.png")

        Storage::delete($path);

        $destroy = $pesticide->delete();

        return redirect('/pesticide');
    }

    private function validateRequest()
    {

        return request()->validate([

            'name'              => 'required',
            'description'       => 'required',
            'type_pesticide'    => 'required',
            'active_principle'  => 'required',
            'carencia'          => 'required',
            'dosagem'           => 'required',
            'indicacoes'        => 'required',
            'packing'           => 'required',
            'unity'             => 'required',
            'manufacturer'      => 'required',
            'price'             => 'required',
            'price_unit'        => 'required',
            'in_use'            => 'required',
            'note'              => 'required',
            
    
       ]);


    }
}
