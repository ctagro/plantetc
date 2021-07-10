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
use App\Models\Category_pesticide;

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


 //   $category_pesticides = Category_pesticide::where('in_use', '=', "S")->get();

   // dd($pesticides);

   $pesticides = pesticide::all();

    // dd($pesticides);   

        return view('pesticide.pesticide.index', compact('pesticides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = auth()->user();

        $category_pesticides = Category_pesticide::where('in_use', '=', "S")->get();


 //       $pesticide = new \App\Models\pesticide([
 //       ]);

       $pesticide = new pesticide();

     //  dd($pesticide);

        return view('pesticide.pesticide.create',compact('pesticide','category_pesticides'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, pesticide $pesticide)
    {
      //dd($request);

        $data = $this->validateRequest();

        //dd($data, $data['name']);
    
    // -------------   Upload da image -------------------
        if ($request->file('image') === null){
            $data['image'] = 'pesticide_avatar.png';
            }
        else{
            if ($request->file('image')->isValid() && $request->file('image')->isValid()) {
              
            //cria um nome para a imagem concatenado id e nome do user
                $name = $data['name']."_image";   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $data['image'] = $nameFile;
                   
                $upload = $request->file('image')->storeAs('pesticides', $nameFile);
            }
        }

    // -------------   Upload da medicine_insert (Bula) -------------------

        if ($request->file('medicine_insert') === null){
            $data['medicine_insert'] = 'medicine_insert_avatar.jpeg';
            }
        else{
                if ($request->file('medicine_insert')->isValid() && $request->file('medicine_insert')->isValid()) {
                  
            //cria um nome para a medicine_insert concatenado id e nome do user
                $name = $data['name']."_bula";   // tirar os espacos com o kebab_case
                $extenstion = $request->medicine_insert->extension(); // reguperar a extensao do arquivo de medicine_insertm
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $data['medicine_insert'] = $nameFile;
                       
                $upload = $request->file('medicine_insert')->storeAs('pesticides', $nameFile);
            }
        }



        $pesticide = new pesticide();

        // relacionando pesticidas com  principios ativos

        //dd($pesticide);
        //dd($data);
       

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

        $category_pesticides = Category_pesticide::where('in_use', '=', "S")->get();



        return view('pesticide.pesticide.edit',compact('pesticide','category_pesticides'));
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


     //----------------Upload image---------------

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $nameFile = $pesticide['image'];
              
            if  ($nameFile == "pesticide_avatar.png"){
    
                //cria um nome para a imagem concatenado id e nome do user
                $name = $dataRequest['name']."_image";   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $pesticide['image'] = $nameFile;
                //dd($nameFile);
            }
        
            //dd($nameFile);

            $upload = $request->file('image')->storeAs('pesticides', $nameFile);

            if (!$upload)
            return redirect() 
                        ->back()
                        ->with('error', 'Falha ao fazer o upload');
        }

        //----------------Upload medecine_insert---------------


        if ($request->hasFile('medicine_insert') && $request->file('medicine_insert')->isValid()) {

            $nameFile = $pesticide['medicine_insert'];
              
            if  ($nameFile == "medicine_insert_avatar.jpeg"){
    
                //cria um nome para a medicine_insertm concatenado id e nome do user
                $name = $dataRequest['name']."_bula";   // tirar os espacos com o kebab_case
                $extenstion = $request->medicine_insert->extension(); // reguperar a extensao do arquivo de medicine_insertm
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $pesticide['medicine_insert'] = $nameFile;
                //dd($nameFile);
            }

            $upload = $request->file('medicine_insert')->storeAs('pesticides', $nameFile);

            if (!$upload)
            return redirect() 
                        ->back()
                        ->with('error', 'Falha ao fazer o upload');
        }

       //dd($dataRequest);

        $data['name']                   = $dataRequest['name'];
        $data['manufacturer']           = $dataRequest['manufacturer'];
        $data['category_pesticide_id']  = $dataRequest['category_pesticide_id'];
        $data['application']            = $dataRequest['application'];
        $data['active_principle_id']    = $dataRequest['active_principle_id'];
        $data['grace_period']           = $dataRequest['grace_period'];
        $data['dosage']                 = $dataRequest['dosage'];
        $data['packing']                = $dataRequest['packing'];
        $data['unity']                  = $dataRequest['unity'];
        $data['price']                  = $dataRequest['price'];
        $data['price_unit']             = $dataRequest['price_unit'];
        $data['image']                  = $pesticide['image'];    
        $data['medicine_insert']        = $pesticide['medicine_insert'];
        $data['in_use']                 = $dataRequest['in_use'];

       

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

            'name'                          => 'required',
            'manufacturer'                  => 'required',
            'category_pesticide_id'         => 'required',
            'application'                   => 'required',
            'active_principle_id'           => 'required',
            'grace_period'                  => 'required',
            'dosage'                        => 'required',
            'packing'                       => 'required',
            'unity'                         => 'required',
            'price'                         => 'required',
            'price_unit'                    => 'required',
     //       'image'             => 'required',
     //       'medicine_insert'   => 'required',   
            'in_use'                        => 'required',

            
    
       ]);


    }
}
